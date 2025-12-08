@extends('layouts.app')

@section('title', 'Laporan') @section('subtitle', '')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div>
            <label class="block text-xs font-bold mb-1 text-gray-700">Periode</label>
            <div class="relative">
                <select class="w-full border border-gray-300 rounded-lg p-2 text-sm appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option>Mingguan</option>
                    <option>Bulanan</option>
                    <option>Tahunan</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-gray-400 text-xs"></i>
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold mb-1 text-gray-700">Tanggal</label>
            <input type="date" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
            <label class="block text-xs font-bold mb-1 text-gray-700">Pencarian</label>
            <div class="flex">
                <div class="relative flex-1">
                    <input type="text" class="w-full border border-gray-300 rounded-l-lg p-2 pl-8 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Search...">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
                </div>
                <div class="flex ml-2 space-x-1">
                    <button class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-2 rounded-lg font-bold transition flex items-center">
                        <i class="fa-solid fa-file-excel mr-1"></i> XLS
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-2 rounded-lg font-bold transition flex items-center">
                        <i class="fa-solid fa-file-pdf mr-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="bg-green-100 text-green-500 w-16 h-16 flex items-center justify-center rounded-xl text-3xl mr-4">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase">Total Penjualan</p>
                <h3 class="text-2xl font-extrabold text-gray-800">Rp 827.000</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="bg-blue-100 text-blue-600 w-16 h-16 flex items-center justify-center rounded-xl text-3xl mr-4">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase">Total Transaksi</p>
                <h3 class="text-2xl font-extrabold text-gray-800">15</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="bg-red-100 text-red-600 w-16 h-16 flex items-center justify-center rounded-xl text-3xl mr-4">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase">Total Profit</p>
                <h3 class="text-2xl font-extrabold text-gray-800">Rp 388.000</h3>
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
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center"><span class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">1</span></td>
                        <td class="p-4 font-medium">Nasi Goreng</td>
                        <td class="p-4">20</td>
                        <td class="p-4 font-medium">Rp 165.000</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center"><span class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">2</span></td>
                        <td class="p-4 font-medium">Soto Ayam</td>
                        <td class="p-4">18</td>
                        <td class="p-4 font-medium">Rp 145.000</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center"><span class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">3</span></td>
                        <td class="p-4 font-medium">Sate Ayam</td>
                        <td class="p-4">18</td>
                        <td class="p-4 font-medium">Rp 135.000</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center"><span class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">4</span></td>
                        <td class="p-4 font-medium">Kopi Hitam</td>
                        <td class="p-4">18</td>
                        <td class="p-4 font-medium">Rp 100.000</td>
                    </tr>
                     <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center"><span class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">5</span></td>
                        <td class="p-4 font-medium">Es Teh Manis</td>
                        <td class="p-4">15</td>
                        <td class="p-4 font-medium">Rp 80.000</td>
                    </tr>
                     <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center"><span class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">6</span></td>
                        <td class="p-4 font-medium">Air Mineral</td>
                        <td class="p-4">10</td>
                        <td class="p-4 font-medium">Rp 55.000</td>
                    </tr>
                     <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center"><span class="bg-black text-white w-7 h-7 rounded-md inline-flex items-center justify-center text-xs font-bold">7</span></td>
                        <td class="p-4 font-medium">Jus Alpukat</td>
                        <td class="p-4">5</td>
                        <td class="p-4 font-medium">Rp 40.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- Tambahkan Section Scripts untuk Chart.js --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- Konfigurasi Bar Chart (Produk Terlaris) ---
    const ctxBar = document.getElementById('topProductsChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Nasi Goreng', 'Soto Ayam', 'Sate Ayam', 'Kopi Hitam', 'Es Teh Manis'],
            datasets: [{
                label: 'Terjual',
                data: [135000, 110000, 65000, 45000, 20000], // Data dummy disesuaikan visual
                backgroundColor: [
                    'rgba(147, 130, 245, 0.8)', // Ungu
                    'rgba(249, 143, 143, 0.8)', // Merah
                    'rgba(116, 203, 248, 0.8)', // Biru Muda
                    'rgba(245, 208, 117, 0.8)', // Kuning
                    'rgba(117, 169, 245, 0.8)'  // Biru
                ],
                borderColor: 'transparent',
                borderWidth: 0,
                borderRadius: 4,
                barThickness: 25, // Mengatur ketebalan batang
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false } // Sembunyikan legend default
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6', // Warna grid abu-abu terang
                        borderDash: [5, 5]
                    },
                    ticks: { display: false } // Sembunyikan angka di sumbu Y
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            }
        }
    });

    // --- Konfigurasi Donut Chart (Metode Pembayaran) ---
    const ctxDonut = document.getElementById('paymentMethodsChart').getContext('2d');

    // Plugin custom untuk teks di tengah (Angka "100")
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

            var text = "100";
            
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
            labels: ['DANA', 'GOPAY', 'CASH', 'BANK', 'OVO'],
            datasets: [{
                data: [25, 25, 30, 5, 15], // Persentase sesuai gambar
                backgroundColor: [
                    '#6366F1', // DANA (Indigo)
                    '#F59E0B', // GOPAY (Amber)
                    '#EC4899', // CASH (Pink)
                    '#06B6D4', // BANK (Cyan)
                    '#8B5CF6'  // OVO (Purple)
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
                    position: 'right', // Posisi legend di kanan
                    labels: {
                        boxWidth: 12,
                        usePointStyle: true, // Gunakan titik bulat untuk legend
                        font: { size: 11 }
                    }
                }
            }
        },
        plugins: [centerTextPlugin] // Aktifkan plugin teks tengah
    });
</script>
@endpush