@extends('layouts.app')

@section('title', 'Laporan') @section('subtitle', '')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div>
            <label class="block text-xs font-bold mb-1 text-gray-700">Periode</label>
            <div class="relative">
                <select name="period" onchange="this.form.submit()"
                    class="w-full border border-gray-300 rounded-lg p-2 text-sm appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                    <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-gray-400 text-xs"></i>
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold mb-1 text-gray-700">Tanggal Mulai</label>
            <input type="date" name="start_date" value="{{ $startDate }}" onchange="this.form.submit()"
                class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
            <label class="block text-xs font-bold mb-1 text-gray-700">Tanggal Akhir</label>
            <input type="date" name="end_date" value="{{ $endDate }}" onchange="this.form.submit()"
                class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
    </div>
    <form method="GET" action="{{ route('laporan') }}" class="hidden">
        <input type="hidden" name="period" value="{{ $period }}">
        <input type="hidden" name="start_date" value="{{ $startDate }}">
        <input type="hidden" name="end_date" value="{{ $endDate }}">
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="bg-green-100 text-green-500 w-16 h-16 flex items-center justify-center rounded-xl text-3xl mr-4">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase">Total Penjualan</p>
                <h3 class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="bg-blue-100 text-blue-600 w-16 h-16 flex items-center justify-center rounded-xl text-3xl mr-4">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase">Total Transaksi</p>
                <h3 class="text-2xl font-extrabold text-gray-800">{{ $totalTransactions }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="bg-red-100 text-red-600 w-16 h-16 flex items-center justify-center rounded-xl text-3xl mr-4">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase">Rata-rata per Transaksi</p>
                <h3 class="text-2xl font-extrabold text-gray-800">Rp
                    {{ $totalTransactions > 0 ? number_format($totalSales / $totalTransactions, 0, ',', '.') : '0' }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold font-serif mb-6 text-gray-800">Produk Terlaris</h3>
            <div class="relative h-80">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold font-serif mb-6 text-gray-800">Metode Pembayaran</h3>
            <div class="relative h-80 flex justify-center items-center">
                <canvas id="paymentMethodsChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <h3 class="text-xl font-bold font-serif mb-6 text-gray-800">Detail Produk Terlaris</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200 font-bold text-gray-600 uppercase tracking-wider">
                    <tr>
                        <th class="p-4 text-center w-16">Rank</th>
                        <th class="p-4">Produk</th>
                        <th class="p-4">Qty Terjual</th>
                        <th class="p-4">Revenue</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @foreach ($topProducts as $index => $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-center"><span
                                    class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">{{ $index + 1 }}</span>
                            </td>
                            <td class="p-4 font-medium">{{ $product['name'] }}</td>
                            <td class="p-4">{{ $product['total_qty'] }}</td>
                            <td class="p-4 font-medium">Rp {{ number_format($product['total_revenue'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    @if ($topProducts->isEmpty())
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Belum ada data penjualan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- Konfigurasi Bar Chart (Produk Terlaris) ---
        const ctxBar = document.getElementById('topProductsChart').getContext('2d');

        // Data produk terlaris dari PHP
        const topProductsData = @json($topProducts);
        const productLabels = topProductsData.map(item => item.name);
        const productSales = topProductsData.map(item => item.total_revenue);

        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: productLabels.length > 0 ? productLabels : ['Belum ada data'],
                datasets: [{
                    label: 'Revenue',
                    data: productSales.length > 0 ? productSales : [0],
                    backgroundColor: [
                        'rgba(147, 130, 245, 0.8)', // Ungu
                        'rgba(249, 143, 143, 0.8)', // Merah
                        'rgba(116, 203, 248, 0.8)', // Biru Muda
                        'rgba(245, 208, 117, 0.8)', // Kuning
                        'rgba(117, 169, 245, 0.8)', // Biru
                        'rgba(167, 243, 208, 0.8)', // Hijau
                        'rgba(252, 165, 165, 0.8)', // Merah Muda
                        'rgba(196, 181, 253, 0.8)', // Ungu Muda
                        'rgba(253, 230, 138, 0.8)', // Kuning Muda
                        'rgba(165, 243, 252, 0.8)' // Cyan
                    ],
                    borderColor: 'transparent',
                    borderWidth: 0,
                    borderRadius: 4,
                    barThickness: 25,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            },
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        // --- Konfigurasi Donut Chart (Metode Pembayaran) ---
        const ctxDonut = document.getElementById('paymentMethodsChart').getContext('2d');

        // Data metode pembayaran dari PHP
        const paymentMethodsData = @json($paymentMethods);
        const paymentLabels = Object.keys(paymentMethodsData);
        const paymentValues = Object.values(paymentMethodsData);
        const totalPayments = paymentValues.reduce((sum, val) => sum + val, 0);

        // Plugin custom untuk teks di tengah
        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw: function(chart) {
                if (chart.config.type !== 'doughnut') return;

                var width = chart.width,
                    height = chart.height,
                    ctx = chart.ctx;

                ctx.restore();
                var fontSize = (height / 150).toFixed(2);
                ctx.font = "bold " + fontSize + "em sans-serif";
                ctx.textBaseline = "middle";

                var text = totalPayments.toString();

                var centerX = (chart.chartArea.left + chart.chartArea.right) / 2;
                var centerY = (chart.chartArea.top + chart.chartArea.bottom) / 2;

                var textX = Math.round(centerX - (ctx.measureText(text).width / 2));
                var textY = centerY;

                ctx.fillStyle = "#374151";
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        };

        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: paymentLabels.length > 0 ? paymentLabels : ['Belum ada data'],
                datasets: [{
                    data: paymentValues.length > 0 ? paymentValues : [1],
                    backgroundColor: [
                        '#6366F1', // DANA (Indigo)
                        '#F59E0B', // GOPAY (Amber)
                        '#EC4899', // CASH (Pink)
                        '#06B6D4', // BANK (Cyan)
                        '#8B5CF6' // OVO (Purple)
                    ],
                    borderWidth: 0,
                    cutout: '65%' // Ukuran lubang tengah
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            usePointStyle: true,
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            },
            plugins: [centerTextPlugin]
        });
    </script>
@endpush
