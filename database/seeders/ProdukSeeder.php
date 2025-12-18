<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Produk::create([
            'name' => 'Nasi Goreng',
            'category' => 'Makanan',
            'price' => 15000,
            'stock' => 50,
        ]);

        \App\Models\Produk::create([
            'name' => 'Sate Ayam',
            'category' => 'Makanan',
            'price' => 10000,
            'stock' => 30,
        ]);

        \App\Models\Produk::create([
            'name' => 'Soto Ayam',
            'category' => 'Makanan',
            'price' => 18000,
            'stock' => 25,
        ]);

        \App\Models\Produk::create([
            'name' => 'Kopi Hitam',
            'category' => 'Minuman',
            'price' => 7000,
            'stock' => 40,
        ]);

        \App\Models\Produk::create([
            'name' => 'Cireng',
            'category' => 'Cemilan',
            'price' => 10000,
            'stock' => 35,
        ]);

        \App\Models\Produk::create([
            'name' => 'Es Teh Manis',
            'category' => 'Minuman',
            'price' => 5000,
            'stock' => 60,
        ]);
    }
}
