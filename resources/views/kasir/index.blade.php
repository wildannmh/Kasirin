<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIRIN - Point of Sale</title>
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .bg-primary {
            background-color: #FBBF46;
        }

        .text-primary {
            color: #FBBF46;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen overflow-hidden font-sans" x-data="kasirApp()">

    <div class="flex h-full">

        <div class="flex-1 flex flex-col h-full relative">

            <div class="px-8 py-6 flex justify-between items-center bg-gray-50/50">
                <h1 class="text-4xl font-bold text-gray-800 font-montserrat tracking-wide">
                    <i class="fa-solid fa-cart-shopping text-orange-500 mr-2"></i>
                    <span class="text-orange-500">KASIR</span><span class="text-black">IN</span>
                </h1>
                <div class="text-gray-600 text-sm font-medium">Minggu, 7 Desember 2025</div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="flex items-center text-brown-800 font-bold text-lg hover:text-red-700 transition">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2 rotate-180"></i> KELUAR
                    </button>
                </form>
            </div>

            <div class="px-8 pb-4">
                <div class="relative mb-4">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" x-model="search"
                        class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 bg-transparent"
                        placeholder="Search Item...">
                </div>

                <div class="flex space-x-3 overflow-x-auto scrollbar-hide">
                    <button @click="category = 'Semua'"
                        :class="category === 'Semua' ? 'bg-black text-white border-black' :
                            'bg-white text-gray-600 border-gray-200'"
                        class="px-6 py-2 rounded-lg text-sm font-bold border shadow-sm transition">Semua</button>
                    <template x-for="cat in categories" :key="cat">
                        <button @click="category = cat"
                            :class="category === cat ? 'bg-black text-white border-black' :
                                'bg-white text-gray-600 border-gray-200'"
                            class="px-6 py-2 rounded-lg text-sm font-bold border shadow-sm transition"
                            x-text="cat"></button>
                    </template>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto px-8 pb-20">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full hover:shadow-md transition">
                            <div class="h-32 bg-gray-200 w-full relative">
                                <img :src="product.image" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4 flex flex-col flex-1 justify-between">
                                <div>
                                    <h3 class="font-bold text-gray-800 text-sm leading-tight" x-text="product.name">
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1" x-text="product.category"></p>
                                </div>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-blue-600 font-bold text-sm"
                                        x-text="formatRupiah(product.price)"></span>
                                    <button @click="addToCart(product)"
                                        class="bg-blue-600 text-white w-6 h-6 rounded-full flex items-center justify-center hover:bg-blue-700 shadow-sm">
                                        <i class="fa-solid fa-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div class="w-[400px] bg-white shadow-2xl border-l border-gray-200 flex flex-col h-full z-20">
            <div class="p-6 border-b border-gray-100 bg-white">
                <div class="flex items-center space-x-3">
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <i class="fa-solid fa-cart-shopping text-orange-500"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">Keranjang</h2>
                        <p class="text-xs text-gray-500"><span x-text="cart.length"></span> Item</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-white">

                <div x-show="cart.length === 0" class="flex flex-col items-center justify-center h-full text-gray-400">
                    <i class="fa-solid fa-cart-shopping text-6xl mb-4 opacity-20"></i>
                    <p class="text-sm">Keranjang kosong</p>
                    <p class="text-xs">Mulai Tambahkan Produk</p>
                </div>

                <template x-for="(item, index) in cart" :key="index">
                    <div
                        class="bg-orange-50/50 p-3 rounded-lg border border-orange-100 flex items-center animate-pulse-once">
                        <img :src="item.image"
                            class="w-12 h-12 rounded-md object-cover mr-3 border border-white shadow-sm">
                        <div class="flex-1">
                            <h4 class="font-bold text-sm text-gray-800" x-text="item.name"></h4>
                            <p class="text-xs text-blue-600 font-bold" x-text="formatRupiah(item.price)"></p>
                        </div>
                        <div class="flex flex-col items-end space-y-2">
                            <button @click="removeFromCart(index)" class="text-red-400 hover:text-red-600">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                            <div
                                class="flex items-center space-x-2 bg-white rounded-full px-2 py-1 shadow-sm border border-gray-200">
                                <button @click="updateQty(index, -1)"
                                    class="w-4 h-4 flex items-center justify-center bg-black text-white rounded-full text-[10px] disabled:opacity-50"><i
                                        class="fa-solid fa-minus"></i></button>
                                <span class="text-xs font-bold w-4 text-center" x-text="item.qty"></span>
                                <button @click="updateQty(index, 1)"
                                    class="w-4 h-4 flex items-center justify-center bg-black text-white rounded-full text-[10px]"><i
                                        class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div class="p-6 bg-white border-t border-gray-100">
                <div class="flex justify-between items-center mb-2 text-sm">
                    <span class="text-gray-500">Subtotal</span>
                    <span class="font-bold" x-text="formatRupiah(subtotal)"></span>
                </div>
                <div class="flex justify-between items-center mb-6 text-xl">
                    <span class="font-bold text-gray-800">Total</span>
                    <span class="font-bold text-blue-600" x-text="formatRupiah(subtotal)"></span>
                </div>
                <button @click="cart.length > 0 ? modalPayment = true : alert('Keranjang masih kosong!')"
                    :class="cart.length > 0 ? 'bg-primary hover:bg-yellow-500' : 'bg-gray-300 cursor-not-allowed'"
                    class="w-full text-black font-bold py-3 rounded-xl transition shadow-lg">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    <div x-show="modalPayment"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
        x-transition>
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-[500px] text-center relative">
            <h2 class="text-2xl font-serif font-bold mb-8">Pembayaran</h2>
            <div class="grid grid-cols-2 gap-4">
                <button @click="selectPayment('CASH')"
                    class="border-2 border-gray-200 rounded-xl p-6 font-bold text-xl hover:border-black hover:bg-gray-50 transition">CASH</button>
                <button @click="selectPayment('OVO')"
                    class="border-2 border-gray-200 rounded-xl p-6 font-bold text-xl hover:border-black hover:bg-gray-50 transition">OVO</button>
                <button @click="selectPayment('DANA')"
                    class="border-2 border-gray-200 rounded-xl p-6 font-bold text-xl hover:border-black hover:bg-gray-50 transition">DANA</button>
                <button @click="selectPayment('GOPAY')"
                    class="border-2 border-gray-200 rounded-xl p-6 font-bold text-xl hover:border-black hover:bg-gray-50 transition">GOPAY</button>
            </div>
            <div class="mt-4">
                <button @click="selectPayment('BANK')"
                    class="border-2 border-gray-200 rounded-xl p-6 font-bold text-xl hover:border-black hover:bg-gray-50 transition w-full">BANK</button>
            </div>
            <button @click="modalPayment = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><i
                    class="fa-solid fa-xmark text-xl"></i></button>
        </div>
    </div>

    <div x-show="modalCash"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
        x-transition>
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-[400px] text-center relative">
            <h2 class="text-2xl font-serif font-bold mb-6">CASH</h2>

            <input type="number" x-model="cashAmount"
                class="w-full border border-gray-300 rounded-lg p-3 text-xl text-center mb-4 focus:outline-none focus:ring-2 focus:ring-black"
                placeholder="Jumlah uang">

            <p class="text-left font-bold text-sm mb-2 text-gray-600">Nominal Cepat</p>
            <div class="grid grid-cols-2 gap-3 mb-6">
                <button @click="cashAmount = 20000"
                    class="border border-gray-300 rounded-lg py-2 hover:bg-gray-100 font-bold">Rp 20.000</button>
                <button @click="cashAmount = 50000"
                    class="border border-gray-300 rounded-lg py-2 hover:bg-gray-100 font-bold">Rp 50.000</button>
                <button @click="cashAmount = 100000"
                    class="border border-gray-300 rounded-lg py-2 hover:bg-gray-100 font-bold">Rp 100.000</button>
                <button @click="cashAmount = 200000"
                    class="border border-gray-300 rounded-lg py-2 hover:bg-gray-100 font-bold">Rp 200.000</button>
            </div>

            <div class="flex justify-between border-t pt-4 mb-4">
                <span>Total Tagihan:</span>
                <span class="font-bold text-blue-600" x-text="formatRupiah(subtotal)"></span>
            </div>

            <button @click="processPayment()"
                class="w-full bg-primary text-black font-bold py-3 rounded-lg hover:bg-yellow-500 transition">
                Proses Bayar
            </button>
            <button @click="modalCash = false" class="absolute top-4 right-4 text-gray-400 hover:text-black"><i
                    class="fa-solid fa-xmark text-xl"></i></button>
        </div>
    </div>

    <div x-show="modalSuccess"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
        x-transition>
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-[400px] text-center relative border-t-8 border-green-500">
            <div class="mb-4">
                <i class="fa-solid fa-circle-check text-6xl text-green-500"></i>
            </div>
            <h2 class="text-2xl font-bold mb-2">Pembayaran Berhasil!</h2>

            <div class="bg-green-100 p-4 rounded-xl border border-green-200 mb-6 mt-4">
                <p class="text-sm text-green-800 mb-1">Kembali</p>
                <p class="text-3xl font-bold text-green-900" x-text="formatRupiah(change)"></p>
            </div>

            <button @click="resetCart()"
                class="w-full bg-primary text-black font-bold py-3 rounded-lg hover:bg-yellow-500 transition">
                Selesai & Transaksi Baru
            </button>
        </div>
    </div>

    <script>
        function kasirApp() {
            return {
                search: '',
                category: 'Semua',
                modalPayment: false,
                modalCash: false,
                modalSuccess: false,
                cashAmount: '',
                change: 0,

                init() {
                    fetch('{{ route('kasir.produks') }}')
                        .then(res => res.json())
                        .then(data => {
                            this.products = data;
                        })
                        .catch(err => {
                            console.error('Gagal ambil produk:', err);
                        });
                },

                cart: [],

                // Filter Produk
                get filteredProducts() {
                    return this.products.filter(p => {
                        const matchesSearch = p.name.toLowerCase().includes(this.search.toLowerCase());
                        const matchesCategory = this.category === 'Semua' || p.category === this.category;
                        return matchesSearch && matchesCategory;
                    });
                },

                // Kategori unik dari produk
                get categories() {
                    const uniqueCategories = [...new Set(this.products.map(p => p.category))];
                    return uniqueCategories;
                },

                // Total Harga
                get subtotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },

                // Logic Cart
                addToCart(product) {
                    const index = this.cart.findIndex(item => item.id === product.id);
                    if (index !== -1) {
                        this.cart[index].qty++;
                    } else {
                        this.cart.push({
                            ...product,
                            qty: 1
                        });
                    }
                },
                updateQty(index, change) {
                    this.cart[index].qty += change;
                    if (this.cart[index].qty <= 0) {
                        this.removeFromCart(index);
                    }
                },
                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },

                // Logic Pembayaran
                selectPayment(method) {
                    this.modalPayment = false;
                    if (method === 'CASH') {
                        this.cashAmount = ''; // Reset input
                        this.modalCash = true;
                    } else {
                        // Process non-cash payment
                        fetch('{{ route('kasir.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    cart: this.cart,
                                    payment_method: method,
                                    paid_amount: this.subtotal
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.change = 0;
                                    this.modalSuccess = true;
                                } else {
                                    alert('Terjadi kesalahan: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat memproses transaksi');
                            });
                    }
                },
                processPayment() {
                    if (this.cashAmount < this.subtotal) {
                        alert('Uang tidak cukup!');
                        return;
                    }
                    this.change = this.cashAmount - this.subtotal;

                    // Send transaction to backend
                    fetch('{{ route('kasir.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                cart: this.cart,
                                payment_method: 'CASH',
                                paid_amount: this.cashAmount
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.modalCash = false;
                                this.modalSuccess = true;
                            } else {
                                alert('Terjadi kesalahan: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memproses transaksi');
                        });
                },
                resetCart() {
                    this.cart = [];
                    this.modalSuccess = false;
                },

                // Helper Format Rupiah
                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
</body>

</html>
