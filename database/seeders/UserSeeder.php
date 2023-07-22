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
            'username' => 'arvin',
            'name' => 'M. Arvin Ardhana',
            'nim' => '120120',
            'email' => 'arvin84@gmail.com',
            'password' => Hash::make('halo1234'),
        ]);
    }
}
