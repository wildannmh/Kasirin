@extends('layouts.app')

@section('title', 'Edit Produk')
@section('subtitle', '')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Produk</h2>
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name', $produk->name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" name="category" id="category" value="{{ old('category', $produk->category) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" id="price" step="0.01"
                    value="{{ old('price', $produk->price) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $produk->stock) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                @if ($produk->photo)
                    <img src="{{ asset('storage/' . $produk->photo) }}" alt="Current Photo"
                        class="w-20 h-20 object-cover mb-2">
                @endif
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.produk.index') }}" class="ml-2 text-gray-600">Batal</a>
        </form>
    </div>
@endsection
