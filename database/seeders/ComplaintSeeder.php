<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complaint::create([
            'subject' => 'Halo halo',
            'content' => 'test komplain',
            'status' => 'sent',
            'category_id' => 1,
            'user_id' => 1,
        ]);
    }
}
