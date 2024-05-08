<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Sarung Tenun',
            'price' => 240000,
            'description' => 'Sarung tenun terbaik sepanjang masa',
            'stock' => 200,
            'image' => 'product_images/f2f0a531-3a7d-451e-b1bc-7cdf5bda48f3_1715101732.png',
        ]);

        Product::create([
            'name' => 'Pecil Lipat',
            'price' => 35000,
            'description' => 'Pecil lipat sangat awet',
            'stock' => 200,
            'image' => 'product_images/0cc659c9-25b8-4e1d-ab9c-fe074a72812d_1715101775.png',
        ]);
    }
}
