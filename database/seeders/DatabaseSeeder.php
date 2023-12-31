<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // buatkan seeder pada tabel pengelola untuk admin, waiter, dan chef

        \App\Models\User::factory()->create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'profile' => '/images/user/admin.jpg',
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'email' => 'waiter@gmail.com',
            'name' => 'waiter satu',
            'password' => bcrypt('waiter'),
            'profile' => '/images/waiter/waiter satu.jpg',
            'role' => 'waiter',
        ]);

        \App\Models\User::factory()->create([
            'email' => 'chef@gmail.com',
            'name' => 'chef satu',
            'profile' => '/images/chef/chef satu.jpg',
            'password' => bcrypt('chef'),
            'role' => "chef",
        ]);

        // buatkan factory 10 kali untuk tables
        \App\Models\Tables::factory(10)->create();

        \App\Models\Menu::factory()->create([
            'name' => 'Nasi Gudeg',
            'slug' => 'nasi-gudeg',
            'type' => 'food',
            'description' => 'Nasi Gudeg merupakan hidangan nasi yang dimasak dengan santan, daun salam, lengkuas, dan bumbu-bumbu.',
            'image' => '/images/menu/makanan/Nasi_Gudeg.jpg',
            'price' => 25000,
            'stock' => 100,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Nasi Liwet',
            'slug' => 'nasi-liwet',
            'type' => 'food',
            'description' => 'Nasi Liwet merupakan hidangan nasi yang dimasak dengan santan, daun salam, lengkuas, dan bumbu-bumbu.',
            'image' => '/images/menu/makanan/Nasi_Liwet.jpg',
            'price' => 17000,
            'stock' => 50,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Rawon',
            'slug' => 'rawon',
            'type' => 'food',
            'description' => 'Rawon merupakan hidangan sup daging berkuah hitam yang terbuat dari kluwek, daging sapi, dan bumbu-bumbu.',
            'image' => '/images/menu/makanan/Rawon.jpeg',
            'price' => 15000,
            'stock' => 75,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Soto',
            'slug' => 'soto',
            'type' => 'food',
            'description' => 'Soto Bandung merupakan hidangan soto khas Bandung yang terbuat dari daging sapi, kentang, dan bumbu-bumbu.',
            'image' => '/images/menu/makanan/soto.jpg',
            'price' => 20000,
            'stock' => 25,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Menu::factory()->create([
            'name' => 'Lontong Sayur',
            'slug' => 'lontong-sayur',
            'type' => 'food',
            'description' => 'Lontong sayur merupakan hidangan nasi yang dimasak bersama sayuran seperti labu siam, kacang panjang, dan bumbu-bumbu.',
            'image' => '/images/menu/makanan/Lontong-Sayur.jpg',
            'price' => 12000,
            'stock' => 10,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        \App\Models\Menu::factory()->create([
                'name' => 'Bajigur',
                'slug' => 'bajigur',
                'type' => 'drink',
                'description' => 'Minuman tradisional khas Sunda yang terbuat dari gula merah, jahe, dan santan kelapa.',
                'image' => '/images/menu/minuman/bajigur.jpg',
                'price' => 7000, // Harga dalam rupiah
                'stock' => 100,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        \App\Models\Menu::factory()->create([
                'name' => 'Es Jeruk',
                'slug' => 'es-jeruk',
                'type' => 'drink',
                'description' => 'Minuman segar yang terbuat dari perasan jeruk manis, gula, dan es batu.',
                'image' => '/images/menu/minuman/esjeruk.jpg',
                'price' => 6000,
                'stock' => 80,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        \App\Models\Menu::factory()->create([
                'name' => 'Es Dawet',
                'slug' => 'es-dawet',
                'type' => 'drink',
                'description' => 'Minuman segar yang terdiri dari agar-agar hijau, tetesan santan, gula merah cair, dan es serut, memberikan rasa manis dan segar.',
                'image' => '/images/menu/minuman/esdawet.jpeg',
                'price' => 10000,
                'stock' => 90,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        \App\Models\Menu::factory()->create([
                'name' => 'Sekoteng',
                'slug' => 'sekoteng',
                'type' => 'drink',
                'description' => 'Minuman hangat yang terdiri dari campuran kacang hijau, potongan roti, pacar cina, dan kadang-kadang biji salak dengan kuah jahe dan gula merah.',
                'image' => '/images/menu/minuman/Sekoteng.jpeg',
                'price' => 8000,
                'stock' => 75,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        \App\Models\Menu::factory()->create([
                'name' => 'Jamu',
                'slug' => 'jamu',
                'type' => 'drink',
                'description' => 'Minuman herbal tradisional yang terbuat dari rempah-rempah seperti kunyit, jahe, temulawak, dan bahan alami lainnya, diyakini memiliki banyak manfaat kesehatan.',
                'image' => '/images/menu/minuman/jamu.jpg',
                'price' => 9000,
                'stock' => 85,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
    }
}
