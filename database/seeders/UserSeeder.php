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
            'username' => 'ahbalqi',
            'name' => 'balqi',
            'nim' => '120120',
            'email' => 'balqi@gmail.com',
            'password' => Hash::make('halo1234'),
        ]);
    }
}
