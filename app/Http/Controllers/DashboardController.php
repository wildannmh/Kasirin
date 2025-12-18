<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Today's date
        $today = Carbon::today();

        // Sales today
        $salesToday = Transaksi::whereDate('created_at', $today)->sum('total');

        // Total transactions (all time)
        $totalTransactions = Transaksi::count();

        // Total products
        $totalProducts = Produk::count();

        // Profit today (assuming profit = sales for now, can be modified later)
        $profitToday = $salesToday;

        // Sales for last 7 days
        $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();
        $dailySales = Transaksi::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total_sales')
        )
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Fill missing dates with 0
        $salesData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $salesData[] = $dailySales->get($date)->total_sales ?? 0;
        }

        // Top selling products (last 30 days)
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $topProducts = DetailTransaksi::with('produk')
            ->select('produk_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->where('transaksis.created_at', '>=', $thirtyDaysAgo)
            ->groupBy('produk_id')
            ->orderBy('total_qty', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->produk->name,
                    'total_qty' => $item->total_qty,
                    'total_revenue' => $item->total_revenue,
                ];
            });

        return view('dashboard', compact(
            'salesToday',
            'totalTransactions',
            'totalProducts',
            'profitToday',
            'salesData',
            'topProducts'
        ));
    }
}
