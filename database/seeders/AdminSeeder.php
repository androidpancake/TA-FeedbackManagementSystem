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
            'username' => 'ilham',
            'name' => 'ilham',
            'nim' => '1223456',
            'email' => 'ilham@gmail.com',
            'password' => Hash::make('tes1234'),
        ]);
    }
}
