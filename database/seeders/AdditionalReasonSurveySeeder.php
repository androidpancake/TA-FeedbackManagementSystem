<?php

namespace Database\Seeders;

use App\Models\AdditionalResponse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionalReasonSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionalResponse::create([
            'reason' => 'Disiplin',
            'for' => 'high',
        ],[
            'reason' => 'Materi powerpoint',
            'for' => 'low',
        ],[
            'reason' => 'Ketepatan waktu',
            'for' => 'low',
        ],[
            'reason' => 'Penguasaan materi',
            'for' => 'low',
        ],[
            'reason' => 'Penampilan',
            'for' => 'low',
        ]);
    }
}
