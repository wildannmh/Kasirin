@extends('layouts.app')

@section('title', 'Produk')
@section('subtitle', '')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 flex justify-between items-center border-b">
            <div class="flex items-center space-x-2">
                <form method="GET" action="{{ route('admin.produk.index') }}" class="flex items-center space-x-2">
                    <select name="category" onchange="this.form.submit()"
                        class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium border-0 focus:ring-2 focus:ring-blue-500 focus:bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </form>
                @if (request('category'))
                    <a href="{{ route('admin.produk.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                        <i class="fa-solid fa-times"></i> Hapus Filter
                    </a>
                @endif
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-700">
                <i class="fa-solid fa-plus mr-1"></i> <a href="{{ route('admin.produk.create') }}"
                    class="text-white no-underline">Tambah Produk</a>
            </button>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-700 text-sm font-bold uppercase">
                    <th class="p-4 border-b">Produk</th>
                    <th class="p-4 border-b">Kategori</th>
                    <th class="p-4 border-b">Harga Jual</th>
                    <th class="p-4 border-b">Stok</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($produks as $produk)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 border-b">
                            <div class="flex items-center">
                                <img src="{{ $produk->photo ? asset('storage/' . $produk->photo) : 'https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80' }}"
                                    alt="{{ $produk->name }}" class="w-12 h-12 rounded object-cover mr-3">
                                <span class="font-medium text-gray-800">{{ $produk->name }}</span>
                            </div>
                        </td>
                        <td class="p-4 border-b text-gray-600">{{ $produk->category }}</td>
                        <td class="p-4 border-b text-gray-600">Rp {{ number_format($produk->price, 0, ',', '.') }}</td>
                        <td class="p-4 border-b text-gray-600">{{ $produk->stock }}</td>
                        <td class="p-4 border-b text-center">
                            <div class="flex flex-col space-y-1">
                                <a href="{{ route('admin.produk.edit', $produk->id) }}"
                                    class="border border-blue-500 text-blue-500 px-2 py-1 rounded text-xs hover:bg-blue-50">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="border border-red-500 text-red-500 px-2 py-1 rounded text-xs hover:bg-red-50"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
