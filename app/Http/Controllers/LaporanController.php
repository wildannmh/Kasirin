<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Get date range from request or default to current month
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $period = $request->get('period', 'monthly');

        // Calculate date range based on period
        switch ($period) {
            case 'weekly':
                $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
                $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
                break;
            case 'monthly':
                $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
            case 'yearly':
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
                $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
                break;
        }

        // Total sales
        $totalSales = Transaksi::whereBetween('created_at', [$startDate, $endDate])->sum('total');

        // Total transactions
        $totalTransactions = Transaksi::whereBetween('created_at', [$startDate, $endDate])->count();

        // Payment methods distribution
        $paymentMethods = Transaksi::whereBetween('created_at', [$startDate, $endDate])
            ->select('payment_method', DB::raw('count(*) as count'))
            ->groupBy('payment_method')
            ->get()
            ->pluck('count', 'payment_method')
            ->toArray();

        // Top selling products
        $topProducts = DetailTransaksi::with('produk')
            ->select('produk_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->whereBetween('transaksis.created_at', [$startDate, $endDate])
            ->groupBy('produk_id')
            ->orderBy('total_qty', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->produk->name,
                    'total_qty' => $item->total_qty,
                    'total_revenue' => $item->total_revenue,
                ];
            });

        // Daily sales for chart
        $dailySales = Transaksi::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total_sales'),
            DB::raw('COUNT(*) as transaction_count')
        )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.laporan.index', compact(
            'totalSales',
            'totalTransactions',
            'paymentMethods',
            'topProducts',
            'dailySales',
            'startDate',
            'endDate',
            'period'
        ));
    }

    public function export(Request $request)
    {
        // This could be implemented for Excel/PDF export
        // For now, return JSON data
        $data = $this->getReportData($request);
        return response()->json($data);
    }

    private function getReportData(Request $request)
    {
        // Similar logic as index method but returns data array
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        return [
            'total_sales' => Transaksi::whereBetween('created_at', [$startDate, $endDate])->sum('total'),
            'total_transactions' => Transaksi::whereBetween('created_at', [$startDate, $endDate])->count(),
            'period' => [$startDate, $endDate]
        ];
    }
}
