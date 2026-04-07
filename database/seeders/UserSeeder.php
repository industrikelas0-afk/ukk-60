<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nisn'         => '1234567890',
            'password'     => Hash::make('password'),
            'nama_lengkap' => 'Rafli',
            'kelas'        => 'XII RPL 1',
            'role'         => 'siswa',
        ]);

        Admin::create([
            'username' => 'admin',
            'nama'     => 'Administrator Sistem', 
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        Admin::create([
            'username' => 'petugas',
            'nama'     => 'Petugas Lapangan',
            'password' => Hash::make('petugas123'),
            'role'     => 'petugas',
        ]);
    }
}