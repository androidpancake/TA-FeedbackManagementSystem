<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Admin::create([
            'username' => 'asti',
            'name' => 'Asti Nur Amaliah',
            'nim' => '123456',
            'role' => 'admin',
            'email' => 'ilham@gmail.com',
            'password' => Hash::make('tes1234'),
        ]);
    }
}
