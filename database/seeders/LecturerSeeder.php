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
            'username' => 'Widyatasya Nurtrisha',
            'role' => 'dosen',
            'name' => 'widyastika',
            'nim' => '122112',
            'email' => 'widya@gmail.com',
            'password' => Hash::make('test1234'),
        ]);
    }
}
