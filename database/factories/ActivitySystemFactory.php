<?php

namespace Database\Factories;

use App\Models\ActivitySystem;

use App\Models\BreadingSystem;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivitySystem>
 */
class ActivitySystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model =ActivitySystem::class;
    public function definition(): array
    {
        $breadingSystemId=BreadingSystem::inRandomOrder()->first()->id;

     return [

                 'name' => fake()->name(),
                 'goal' => fake()->sentence(5),
                 'cause_of_creation' =>fake()-> paragraph(),
                 'description' =>fake()-> paragraph(),
                 'activities' =>fake()-> paragraph(),
                 'breadingsystem_id'=>$breadingSystemId,
                 'sleep_time' => fake()->dateTimeThisMonth(),
                 'wakeup_time' => fake()->dateTimeThisMonth(),
                 'created_at' => now(),
                 'updated_at' => now(),


        ];
//        $factory->define(ActivitySystem::class, function (Faker $faker) {
//            return [
//                'name' => $faker->name,
//                'goal' => $faker->sentence,
//                'cause_of_creation' => $faker->paragraph,
//                'breadingsystem_id' => function () {
//                    return factory(BreadingSystem::class)->create()->id;
//                },
//                'sleep_time' => $faker->dateTimeThisMonth(),
//                'wakeup_time' => $faker->dateTimeThisMonth(),
//                'created_at' => now(),
//                'updated_at' => now(),
//            ];
//        });
   }


}
