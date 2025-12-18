<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Produk::query();

        // Filter berdasarkan kategori jika ada
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $produks = $query->get();

        // Ambil semua kategori unik untuk filter
        $categories = Produk::distinct()->pluck('category')->filter()->sort();

        return view('admin.produk.index', compact('produks', 'categories'));
    }

    public function show($id)
    {
        return view('admin.produk.show', ['id' => $id]);
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'price', 'stock']);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('produk_photos', 'public');
            $data['photo'] = $photoPath;
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->only(['name', 'category', 'price', 'stock']);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($produk->photo && \Storage::disk('public')->exists($produk->photo)) {
                \Storage::disk('public')->delete($produk->photo);
            }
            $photoPath = $request->file('photo')->store('produk_photos', 'public');
            $data['photo'] = $photoPath;
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Delete photo if exists
        if ($produk->photo && \Storage::disk('public')->exists($produk->photo)) {
            \Storage::disk('public')->delete($produk->photo);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        // Logic to search products would go here

        return view('produk.search', ['query' => $query]);
    }

    public function filter(Request $request)
    {
        $criteria = $request->input('criteria');
        // Logic to filter products would go here

        return view('produk.filter', ['criteria' => $criteria]);
    }

    public function sort(Request $request)
    {
        $order = $request->input('order');
        // Logic to sort products would go here

        return view('produk.sort', ['order' => $order]);
    }

    public function paginate(Request $request)
    {
        $page = $request->input('page', 1);
        // Logic to paginate products would go here

        return view('produk.paginate', ['page' => $page]);
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        // Logic to export products would go here

        return response()->download(storage_path("exports/produk.{$format}"));
    }

    public function import(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Logic to import products would go here

            return redirect()->route('produk.index');
        }

        return back()->withErrors(['file' => 'Please upload a valid file.']);
    }

    public function statistics()
    {
        // Logic to gather product statistics would go here

        return view('produk.statistics');
    }

    public function reviews($id)
    {
        // Logic to get product reviews would go here

        return view('produk.reviews', ['id' => $id]);
    }

    public function related($id)
    {
        // Logic to get related products would go here

        return view('produk.related', ['id' => $id]);
    }

    public function wishlist(Request $request)
    {
        $userId = $request->input('user_id');
        // Logic to get user's wishlist would go here

        return view('produk.wishlist', ['userId' => $userId]);
    }

    public function compare(Request $request)
    {
        $productIds = $request->input('product_ids', []);
        // Logic to compare products would go here

        return view('produk.compare', ['productIds' => $productIds]);
    }

    public function featured()
    {
        // Logic to get featured products would go here

        return view('produk.featured');
    }

    public function newArrivals()
    {
        // Logic to get new arrival products would go here

        return view('produk.new_arrivals');
    }

    public function bestSellers()
    {
        // Logic to get best-selling products would go here

        return view('produk.best_sellers');
    }

    public function onSale()
    {
        // Logic to get products on sale would go here

        return view('produk.on_sale');
    }

    public function clearance()
    {
        // Logic to get clearance products would go here

        return view('produk.clearance');
    }

    public function backInStock()
    {
        // Logic to get back-in-stock products would go here

        return view('produk.back_in_stock');
    }
}
