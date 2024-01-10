<?php

namespace Database\Factories;

use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
use App\Models\Cow;
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
        $activityPlaceId=ActivityPlace::inRandomOrder()->first()->id;;
        $activitySystemId=1;
        $breadingSystemId=1;
        return [
            'cowId'=>sprintf("%06d",mt_rand(1,999999)),
            'activityplace_id'=>$activityPlaceId,
            'activitysystem_id'=>$activitySystemId,
            'breadingsystem_id'=>$breadingSystemId,
            'original_area'=>$this->faker->word,
            'appearance'=>$this->faker->word,
            'sex'=>$this->faker->randomElement(['heifer','bull']),
            'entrance_date'=>$this->faker->dateTime,
            'age'=>$this->faker->dateTime,
            'sleep_hour'=>$this->faker->dateTime,
            'eating_duration'=>$this->faker->dateTime,
            'laydown_duration'=>$this->faker->dateTime,
            'weight'=>$this->faker->randomFloat(2,10,1000),
            'milk_amount'=>$this->faker->randomFloat(2,1,10),
            'heart_rate'=>$this->faker->randomFloat(2,20,200),
            'pressure'=>$this->faker->randomFloat(2,60,200),
            'temperature'=>$this->faker->randomFloat(2,30,50),
            'sugar_rate'=>$this->faker->randomFloat(2,50,200),
            'distance'=>$this->faker->randomFloat(2,0,1000000),
            'jaw_movement_rate'=>$this->faker->randomFloat(2,0,10000),
            'movement_rate'=>$this->faker->randomFloat(2,0,10000),
            'cow_status'=>$this->faker->boolean
        ];
    }
}
