<?php

namespace Database\Seeders;

use App\Models\PatientRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PatientRecord::factory()->count(50)->create();
    }
}
