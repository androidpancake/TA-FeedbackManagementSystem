<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feedback::create([
            'subject' => 'Halo halo',
            'content' => 'test123',
            'status' => 'sent',
            'date' => now(),
            'category_id' => 1,
            'user_id' => 1,
            'class_id' => 2
        ],[
            'subject' => 'Halo halo',
            'content' => 'lorem ipsum',
            'status' => 'sent',
            'date' => now(),
            'category_id' => 1,
            'user_id' => 1,
            'class_id' => 2 
        ]);
    }
}
