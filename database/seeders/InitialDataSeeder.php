<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name' => 'Laptop'],
            ['name' => 'CPU'],
            ['name' => 'Card đồ họa'],
            ['name' => 'Màn hình'],
        ])->mapWithKeys(function ($category) {
            $model = Category::firstOrCreate(['name' => $category['name']], $category);

            return [$category['name'] => $model->id];
        });

        $products = [
            [
                'category' => 'Laptop',
                'name' => 'Dell XPS 15',
                'description' => 'Laptop cao cấp màn hình UHD 15", CPU Intel i7-7700HQ, GPU GTX1050.',
                'price' => 34990000,
                'image' => 'images/product/dell-xps-15-1.jpg',
            ],
            [
                'category' => 'Laptop',
                'name' => 'LG Gram 14',
                'description' => 'Laptop siêu nhẹ dưới 1kg, SSD 512GB, RAM 16GB.',
                'price' => 28990000,
                'image' => 'images/product/lg-gram.jpg',
            ],
            [
                'category' => 'CPU',
                'name' => 'Intel Core i7 8700K',
                'description' => 'CPU 6 nhân 12 luồng, 4.7GHz Turbo Boost, socket LGA1151.',
                'price' => 9990000,
                'image' => 'images/product/cpu1.png',
            ],
            [
                'category' => 'Card đồ họa',
                'name' => 'AMD Radeon Vega FE',
                'description' => 'Card đồ họa 16GB HBM2, hiệu năng mạnh mẽ cho thiết kế đồ họa.',
                'price' => 29990000,
                'image' => 'images/product/card1.jpg',
            ],
            [
                'category' => 'Màn hình',
                'name' => 'AOC Razor LED 24"',
                'description' => 'Màn hình siêu mỏng LED, độ tương phản 50.000.000:1.',
                'price' => 4990000,
                'image' => 'images/product/LCD-Razor-LED2.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'category_id' => $categories[$product['category']],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                ]
            );
        }

        $posts = [
            [
                'title' => 'Intel lộ CPU 6 nhân Core i7 8700K',
                'summary' => 'Cuộc chiến CPU dân dụng chưa bao giờ nóng đến thế, kể từ khi AMD tung ra Ryzen.',
                'content' => 'CPU Intel Core i7-8700K với 6 nhân 12 luồng, xung nhịp 4.7GHz Turbo, socket LGA1151, cạnh tranh trực tiếp Ryzen 7 1700X.',
                'image' => 'images/product/cpu2.jpg',
            ],
            [
                'title' => 'AMD Radeon Vega Frontier Edition ra mắt',
                'summary' => 'AMD tung card đồ họa Vega FE mạnh mẽ cho dân thiết kế và nghiên cứu.',
                'content' => 'Card Vega FE có 16GB HBM2, hiệu năng cao hơn Titan Xp 20–50% trong tác vụ dựng hình và AI.',
                'image' => 'images/product/card2.jpg',
            ],
            [
                'title' => 'Dell XPS 15 mới lộ cấu hình',
                'summary' => 'Dell XPS 15 dùng CPU Intel Gen 7 và GPU GTX1050Ti, màn hình UHD 15".',
                'content' => 'Phiên bản XPS 15 (9650) là laptop mạnh mẽ nhất của Dell, phù hợp cho dân sáng tạo nội dung.',
                'image' => 'images/product/dell-xps-15-2.jpg',
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['title' => $post['title']],
                [
                    'summary' => $post['summary'],
                    'content' => $post['content'],
                    'image' => $post['image'],
                ]
            );
        }

        User::updateOrCreate(
            ['email' => 'admin@zaze.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@zaze.com'],
            [
                'name' => 'User',
                'password' => Hash::make('123456'),
                'role' => 'user',
            ]
        );
    }
}
