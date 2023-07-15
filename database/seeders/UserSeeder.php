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
            'username' => 'maul',
            'name' => 'Ilham Maulana Abdurrahman',
            'nim' => '120120',
            'email' => 'maul@gmail.com',
            'password' => Hash::make('halo1234'),
        ]);
    }
}
