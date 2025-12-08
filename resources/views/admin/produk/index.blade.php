@extends('layouts.app')

@section('title', 'Produk')
@section('subtitle', '')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 flex justify-end space-x-2 border-b">
            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200">
                <i class="fa-solid fa-filter mr-1"></i> Kategori
            </button>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-700">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Produk
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
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Nasi Goreng" class="w-12 h-12 rounded object-cover mr-3">
                            <span class="font-medium text-gray-800">Nasi Goreng</span>
                        </div>
                    </td>
                    <td class="p-4 border-b text-gray-600">Makanan</td>
                    <td class="p-4 border-b text-gray-600">Rp 15.000</td>
                    <td class="p-4 border-b text-gray-600">30</td>
                    <td class="p-4 border-b text-center">
                        <div class="flex flex-col space-y-1">
                            <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded text-xs hover:bg-blue-50">
                                <i class="fa-regular fa-pen-to-square"></i> Edit
                            </button>
                            <button class="border border-red-500 text-red-500 px-2 py-1 rounded text-xs hover:bg-red-50">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
        </table>
    </div>
@endsection