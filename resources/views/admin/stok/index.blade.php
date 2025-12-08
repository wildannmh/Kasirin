@extends('layouts.app')

@section('title', 'Stok') @section('subtitle', '')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 flex justify-end border-b">
            <button class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-50 text-gray-700 shadow-sm">
                <i class="fa-solid fa-circle-check text-black"></i>
                <span>Kategori</span>
            </button>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-900 font-bold text-sm border-b">
                    <th class="p-4 w-1/3">Produk</th>
                    <th class="p-4 w-1/4">Kategori</th>
                    <th class="p-4 w-1/6 text-center">Stok</th>
                    <th class="p-4 w-1/6 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                <tr class="hover:bg-gray-50 group transition-colors">
                    <td class="p-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Nasi Goreng" class="w-12 h-12 rounded-lg object-cover mr-4 shadow-sm border">
                            <span class="font-medium text-gray-800">Nasi Goreng</span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600">Makanan</td>
                    <td class="p-4 text-center text-gray-800 font-medium">30</td>
                    <td class="p-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white border border-green-200 text-green-600 shadow-sm">
                            <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Tersedia
                        </span>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50 group transition-colors">
                    <td class="p-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Sate Ayam" class="w-12 h-12 rounded-lg object-cover mr-4 shadow-sm border">
                            <span class="font-medium text-gray-800">Sate Ayam</span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600">Makanan</td>
                    <td class="p-4 text-center text-gray-800 font-medium">30</td>
                    <td class="p-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white border border-green-200 text-green-600 shadow-sm">
                            <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Tersedia
                        </span>
                    </td>
                </tr>

                 <tr class="hover:bg-gray-50 group transition-colors">
                    <td class="p-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Tahu Isi" class="w-12 h-12 rounded-lg object-cover mr-4 shadow-sm border">
                            <span class="font-medium text-gray-800">Tahu Isi</span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600">Camilan</td>
                    <td class="p-4 text-center text-gray-800 font-medium">20</td>
                    <td class="p-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white border border-green-200 text-green-600 shadow-sm">
                            <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Tersedia
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection