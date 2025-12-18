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
                <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($salesToday, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mr-4">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Total Transaksi</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalTransactions, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-16 h-16 bg-pink-700 rounded-lg flex items-center justify-center text-white text-2xl mr-4">
                <i class="fa-solid fa-box"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Total Produk</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalProducts, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center text-white text-2xl mr-4">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Rata-rata Penjualan</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp
                    {{ number_format($profitToday / $totalTransactions, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-bold mb-4 flex items-center"><i class="fa-solid fa-chart-column mr-2 text-brown-800"></i>
            Penjualan 7 Hari Terakhir</h3>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-end justify-between px-10"
            style="height: 256px;">
            @php
                $maxSales = max($salesData) > 0 ? max($salesData) : 1;
                $maxBarHeight = 180; // Maximum bar height in pixels
            @endphp
            @foreach ($salesData as $index => $sales)
                @php
                    $height = $maxSales > 0 ? ($sales / $maxSales) * $maxBarHeight : 0;
                    $date = \Carbon\Carbon::now()
                        ->subDays(6 - $index)
                        ->format('d/m');
                @endphp
                <div class="flex flex-col items-center">
                    <div class="w-4 {{ $sales > 0 ? 'bg-blue-500' : 'bg-gray-300' }} rounded-t mb-2 transition-all duration-300"
                        style="height: {{ max($height, 8) }}px; min-height: 8px;"></div>
                    <span class="text-xs text-gray-500">{{ $date }}</span>
                    <span class="text-xs font-bold text-gray-700">Rp {{ number_format($sales, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h3 class="text-xl font-bold mb-4 flex items-center"><i class="fa-solid fa-cube mr-2 text-brown-800"></i> Produk
            Terlaris</h3>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-4">
            @forelse($topProducts as $index => $product)
                <div class="flex justify-between items-center {{ !$loop->last ? 'border-b pb-2' : '' }}">
                    <div class="flex items-center">
                        <div class="bg-black text-white w-8 h-8 flex items-center justify-center rounded font-bold mr-4">
                            {{ $index + 1 }}</div>
                        <div>
                            <h4 class="font-bold">{{ $product['name'] }}</h4>
                            <p class="text-xs text-gray-500">{{ $product['total_qty'] }} terjual</p>
                        </div>
                    </div>
                    <span class="text-blue-500 font-bold">Rp
                        {{ number_format($product['total_revenue'], 0, ',', '.') }}</span>
                </div>
            @empty
                <div class="text-center text-gray-500 py-8">
                    <i class="fa-solid fa-box-open text-4xl mb-2"></i>
                    <p>Belum ada data penjualan</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
