<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lecturer::create([
            'username' => 'Nia Ambarsari',
            'role' => 'dosen',
            'name' => 'niaambarsari',
            'nim' => '1234567',
            'email' => 'niaambarsari@gmail.com',
            'password' => Hash::make('test1234'),
        ]);
    }
}
