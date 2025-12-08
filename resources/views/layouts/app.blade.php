<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIRIN - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <style>
        .bg-sidebar { background-color: #FBBF46; }
        .text-sidebar-active { color: #FBBF46; }
        .bg-dark-btn { background-color: #000000; }
    </style>
</head>
<body class="bg-gray-50 h-screen flex overflow-hidden">

    <aside class="w-64 bg-sidebar flex flex-col justify-between h-full fixed left-0 top-0 z-10">
        <div>
            <div class="py-6 bg-white m-4 rounded-xl flex items-center justify-center shadow-sm">
                <h1 class="text-3xl font-bold text-gray-800 font-montserrat tracking-wide">
                    <i class="fa-solid fa-cart-shopping text-orange-500 mr-2"></i>
                    <span class="text-orange-500">KASIR</span><span class="text-black">IN</span>
                </h1>
            </div>

            <nav class="mt-6 px-4 space-y-2 text-white font-medium">
                <a href="/dashboard" class="flex items-center px-4 py-3 {{ request()->is('dashboard') ? 'bg-black rounded-full' : '' }}">
                    <i class="fa-solid fa-table-columns w-6"></i> Dashboard
                </a>
                <a href="/produk" class="flex items-center px-4 py-3 {{ request()->is('produk') ? 'bg-black rounded-full' : 'hover:bg-yellow-500 rounded-full transition' }}">
                    <i class="fa-solid fa-box-open w-6"></i> Produk
                </a>
                <a href="/stok" class="flex items-center px-4 py-3 {{ request()->is('stok') ? 'bg-black rounded-full' : 'hover:bg-yellow-500 rounded-full transition' }}">
                    <i class="fa-solid fa-clipboard-list w-6"></i> Stok
                </a>
                <a href="/laporan" class="flex items-center px-4 py-3 {{ request()->is('laporan') ? 'bg-black rounded-full' : 'hover:bg-yellow-500 rounded-full transition' }}">
                    <i class="fa-solid fa-file-invoice w-6"></i> Laporan
                </a>
                <a href="/pengguna" class="flex items-center px-4 py-3 {{ request()->is('pengguna') ? 'bg-black rounded-full' : 'hover:bg-yellow-500 rounded-full transition' }}">
                    <i class="fa-solid fa-users w-6"></i> Pengguna
                </a>
            </nav>
        </div>

        <div class="p-6">
            <hr class="border-black mb-4 opacity-20">
            <a href="/logout" class="flex items-center text-red-900 font-bold hover:text-red-700">
                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> KELUAR
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col ml-64 h-full overflow-y-auto">
        <header class="flex justify-between items-center py-6 px-8 bg-white border-b border-gray-100">
            <div>
                <h2 class="text-3xl font-serif font-bold text-black">@yield('title')</h2>
                <p class="text-gray-500 text-sm mt-1">@yield('subtitle')</p>
            </div>
            <div class="text-gray-600 font-medium">
                Minggu, 7 Desember 2025
            </div>
        </header>

        <main class="p-8">
            @yield('content')
        </main>
    </div>

@stack('scripts') </body>
</html>