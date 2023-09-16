<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'username' => 'barli',
            'name' => 'Barli Khairan',
            'nim' => '1202194330',
            'email' => 'barli@gmail.com',
            'password' => Hash::make('halo1234'),
        ]);
    }
}
