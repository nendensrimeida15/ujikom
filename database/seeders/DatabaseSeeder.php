<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin1',
            'email' => 'admin13@gmail.com',
            'password' => Hash::make('12345'),
            'nama_lengkap' => 'admin_2',
            'role' => 'administrator',
            'verifikasi' => 'sudah',
            'alamat' => 'Subang'
            


        ]);
    }
}
