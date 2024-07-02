<?php

namespace Database\Factories;

use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
use App\Models\BreadingSystem;
use App\Models\Cow;
use App\Models\Purpose;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cow>
 */
class CowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Cow::class;

    public function definition(): array
    {
        $activityPlaceId=ActivityPlace::inRandomOrder()->first()->id;
        $activitySystemId=ActivitySystem::inRandomOrder()->first()->id;
        $breadingSystemId=BreadingSystem::inRandomOrder()->first()->id;
        $purposeId=Purpose::inRandomOrder()->first()->id;

        return [
            'cowId'=>sprintf("%06d",mt_rand(1,999999)),
            'activity_place_id'=>$activityPlaceId,
            'activity_system_id'=>$activitySystemId,
            'breading_system_id'=>$breadingSystemId,
            'purpose_id'=>$purposeId,
            'original_area'=>$this->faker->word,
            'appearance'=>$this->faker->word,
            'gender'=>$this->faker->randomElement(['heifer','bull']),
            'birthday_date'=>$this->faker->dateTimeBetween('-10 year','now'),
            'entrance_date'=>$this->faker->dateTimeBetween('-10 year','now'),
            'age'=>$this->faker->randomNumber(2),
            'image'=>$this->faker->imageUrl(),
            'weight'=>$this->faker->randomFloat(2,10,1000),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'cow_status'=>$this->faker->boolean,
            'is_pregnant'=>$this->faker->boolean(false),
        ];
    }
}
