<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
use App\Models\BreadingSystem;
use App\Models\Cow;
use App\Models\CowFeed;
use App\Models\FeedStock;
use App\Models\Note;
use App\Models\Purpose;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      //   \App\Models\User::factory(10)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);

      // Purpose::factory(5)->create();
        // BreadingSystem::factory(5)->create();
        //ActivitySystem::factory(5)->create();
         //ActivityPlace::factory(5)->create();
        //FeedStock::factory()->count(5)->create();
     //  Cow::factory(5)->create();
       // Note::factory()->count(5)->create();
        CowFeed::factory()->count(5)->create();








    }
}
