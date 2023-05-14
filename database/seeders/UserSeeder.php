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
            'username' => 'arvinar',
            'name' => 'arvin',
            'nim' => '1223456',
            'email' => 'arvin@gmail.com',
            'password' => Hash::make('tes1234'),
        ]);
    }
}
