<?php

namespace Database\Seeders;

use App\Models\LecturerReply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturerReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LecturerReply::create([
            'reply' => 'coba reply feedback dari sisi dosen',
            'feedback_id' => 1,
            'lecturer_id' => 1
        ]);
    }
}
