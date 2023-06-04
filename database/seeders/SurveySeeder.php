<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Survey::create([
            'date' => now(),
            'class_id' => 1,
            'limit_date' => now()->addDay()
        ]);
    }
}
