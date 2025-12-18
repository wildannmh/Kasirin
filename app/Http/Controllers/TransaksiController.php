<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $produks = Produk::where('stock', '>', 0)->get();
        return view('kasir.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|exists:produks,id',
            'cart.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|in:CASH,OVO,DANA,GOPAY,BANK',
            'paid_amount' => 'required_if:payment_method,CASH|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $cart = $request->cart;
            $total = 0;

            // Calculate total and check stock
            foreach ($cart as $item) {
                $produk = Produk::findOrFail($item['id']);
                if ($produk->stock < $item['qty']) {
                    throw new \Exception("Stok {$produk->name} tidak mencukupi");
                }
                $total += $produk->price * $item['qty'];
            }

            // Create transaction
            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'payment_method' => $request->payment_method,
                'paid_amount' => $request->payment_method === 'CASH' ? $request->paid_amount : null,
                'change_amount' => $request->payment_method === 'CASH' ? ($request->paid_amount - $total) : null,
            ]);

            // Create transaction details and reduce stock
            foreach ($cart as $item) {
                $produk = Produk::findOrFail($item['id']);
                $subtotal = $produk->price * $item['qty'];

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'quantity' => $item['qty'],
                    'price' => $produk->price,
                    'subtotal' => $subtotal,
                ]);

                // Reduce stock
                $produk->decrement('stock', $item['qty']);
            }
        });

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil']);
    }

    public function getProduks()
    {
        $produks = Produk::where('stock', '>', 0)
            ->select('id', 'name', 'category', 'price', 'photo')
            ->get()
            ->map(function ($produk) {
                return [
                    'id' => $produk->id,
                    'name' => $produk->name,
                    'category' => $produk->category,
                    'price' => $produk->price,
                    'image' => $produk->photo ? asset('storage/' . $produk->photo) : 'https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80',
                ];
            });

        return response()->json($produks);
    }
}
