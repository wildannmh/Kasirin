@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Welcome, Admin!')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center text-white text-2xl mr-4">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Penjualan Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp 0</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mr-4">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Total Transaksi</p>
                <h3 class="text-2xl font-bold text-gray-800">0</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-16 h-16 bg-pink-700 rounded-lg flex items-center justify-center text-white text-2xl mr-4">
                <i class="fa-solid fa-box"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Total Produk</p>
                <h3 class="text-2xl font-bold text-gray-800">15</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center text-white text-2xl mr-4">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Profit Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp 0</h3>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-bold mb-4 flex items-center"><i class="fa-solid fa-chart-column mr-2 text-brown-800"></i> Penjualan 7 Hari Terakhir</h3>
        <div class="bg-white p-6 rounded-xl shadow-sm h-64 border border-gray-100 flex items-end justify-between px-10">
            <div class="w-4 bg-blue-300 h-1/6 rounded-t"></div>
            <div class="w-4 bg-orange-300 h-1/4 rounded-t"></div>
            <div class="w-4 bg-blue-300 h-3/6 rounded-t"></div>
            <div class="w-4 bg-blue-300 h-4/6 rounded-t"></div>
            <div class="w-4 bg-blue-300 h-5/6 rounded-t"></div>
            <div class="w-4 bg-red-300 h-4/6 rounded-t"></div>
            <div class="w-4 bg-red-300 h-full rounded-t"></div>
        </div>
    </div>

    <div>
        <h3 class="text-xl font-bold mb-4 flex items-center"><i class="fa-solid fa-cube mr-2 text-brown-800"></i> Produk Terlaris</h3>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-4">
            <div class="flex justify-between items-center border-b pb-2">
                <div class="flex items-center">
                    <div class="bg-black text-white w-8 h-8 flex items-center justify-center rounded font-bold mr-4">1</div>
                    <div>
                        <h4 class="font-bold">Air Mineral</h4>
                        <p class="text-xs text-gray-500">15 terjual</p>
                    </div>
                </div>
                <span class="text-blue-500 font-bold">Rp 75.000</span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <div class="flex items-center">
                    <div class="bg-black text-white w-8 h-8 flex items-center justify-center rounded font-bold mr-4">2</div>
                    <div>
                        <h4 class="font-bold">Es Teh Manis</h4>
                        <p class="text-xs text-gray-500">15 terjual</p>
                    </div>
                </div>
                <span class="text-blue-500 font-bold">Rp 60.000</span>
            </div>
        </div>
    </div>
@endsection