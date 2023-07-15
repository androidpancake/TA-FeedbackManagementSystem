<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lab::create([
            'username' => 'amira',
            'name' => 'Amira',
            'nim' => '112233',
            'email' => 'amira@gmail.com',
            'password' => Hash::make('test1234'),
        ]);
    }
}
