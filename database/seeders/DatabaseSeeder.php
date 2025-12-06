<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User awal
        User::firstOrCreate(
            ['email' => 'yuli@example.com'],
            [
                'name' => 'Yuli',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'status' => 'aktif'
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin2@example.com'],
            [
                'name' => 'Admin Dua',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'status' => 'aktif'
            ]
        );

        // =================================================================================
        // HAPUS / BERI KOMENTAR PADA BAGIAN INI KARENA DATANYA SUDAH ADA
        // =================================================================================
        /*
        // Produk contoh
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Velvet Dream Eyeshadow',
                'slug' => 'velvet-dream-eyeshadow-1764065373',
                'description' => 'Palette warna natural untuk pemakaian sehari-hari.',
                'price' => 59000,
                'stock' => 50,
                'image' => 'eyeshadow5.png',
            ],
            [
                'id' => 2,
                'name' => 'Velvet Rose Lipstick',
                'slug' => 'velvet-rose-lipstick-1764065373',
                'description' => 'Lipstick lembut dengan hasil glossy.',
                'price' => 49000,
                'stock' => 50,
                'image' => 'lipstikmerah1remove.png',
            ],
            [
                'id' => 3,
                'name' => 'Flawless Matte Powder',
                'slug' => 'flawless-matte-powder-1764065373',
                'description' => 'Bedak tabur untuk hasil matte sempurna.',
                'price' => 69000,
                'stock' => 50,
                'image' => 'powder2.png',
            ],
            [
                'id' => 4,
                'name' => 'Soft Glow Blush',
                'slug' => 'soft-glow-blush-1764065373',
                'description' => 'Blush on memberikan rona sehat.',
                'price' => 35000,
                'stock' => 50,
                'image' => 'blushon3.png',
            ],
            [
                'id' => 5,
                'name' => 'Flawless Skin Foundation',
                'slug' => 'flawless-skin-foundation-1764065373',
                'description' => 'Foundation ringan menutup sempurna.',
                'price' => 55000,
                'stock' => 50,
                'image' => 'foundation2.png',
            ],
            [
                'id' => 6,
                'name' => 'Feather Lash Mascara',
                'slug' => 'feather-lash-mascara-1764065373',
                'description' => 'Bulu mata lentik maksimal, sentuhan ringan tanpa gumpal.',
                'price' => 39000,
                'stock' => 50,
                'image' => 'mascara3.png',
            ],
        ]);
        */
        // =================================================================================

        // =================================================================================
        // KODE INI YANG AKAN BERJALAN UNTUK MEMPERBAIKI PATH GAMBAR LAMA
        // =================================================================================
        $productsToFix = DB::table('products')->where('image', 'NOT LIKE', 'products%')->get();

        foreach ($productsToFix as $product) {
            $newPath = 'products/' . $product->image;
            DB::table('products')
                ->where('id', $product->id)
                ->update(['image' => $newPath]);
        }
        // =================================================================================

        // Tambahkan seeder manager
        $this->call(ManagerSeeder::class);
    }
}
