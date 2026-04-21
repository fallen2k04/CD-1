<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop Dell XPS 15', 'price' => 25000000],
            ['name' => 'MacBook Pro M2', 'price' => 35000000],
            ['name' => 'Chuột Logitech G102', 'price' => 450000],
            ['name' => 'Bàn phím cơ Keychron K8', 'price' => 1800000],
            ['name' => 'Màn hình LG 27 inch 4K', 'price' => 8500000],
            ['name' => 'Tai nghe Sony WH-1000XM5', 'price' => 7000000],
            ['name' => 'Cáp sạc Anker Powerline', 'price' => 250000],
            ['name' => 'Sạc dự phòng Xiaomi 20000mAh', 'price' => 550000],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
