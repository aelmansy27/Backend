<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
use App\Models\Cow;
use App\Models\Purpose;
use App\Models\Sensor;
use App\Models\Treatment;
use App\Models\TreatmentDoseTimes;
use App\Models\TreatmentStock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        ActivityPlace::factory(5)->create();
        Purpose::factory(5)->create();
        Cow::factory(5)->create();
        TreatmentStock::factory(10)->create();
        Treatment::factory(5)->create();
        TreatmentDoseTimes::factory(10)->create();
        Sensor::factory(30)->create();
    }
}
