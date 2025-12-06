<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek dulu apakah user dengan email ini sudah ada
        // Jika belum ada, maka buat data baru
        if (User::where('email', 'manager@example.com')->doesntExist()) {
            User::create([
                'name'      => 'Manager Toko',
                'email'     => 'manager@example.com',
                'password'  => Hash::make('123456'),
                'role'      => 'manager',
                'no_hp'     => '0812345678',
                'foto'      => null,
                'status'    => 'aktif',
            ]);
        }
    }
}
