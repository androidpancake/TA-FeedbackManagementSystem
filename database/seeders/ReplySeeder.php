<?php

namespace Database\Seeders;

use App\Models\Reply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reply::create([
            'reply' => 'coba reply feedback dari dosen',
            'feedback_id' => 1,
            'lecturer_id' => 1
        ]);
    }
}
