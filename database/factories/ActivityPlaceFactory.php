<?php

namespace Database\Factories;

use App\Enums\ActivityType;
use App\Models\ActivityPlace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityPlace>
 */
class ActivityPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=ActivityPlace::class;
    public function definition(): array
    {
        $activitySystemId=1;
        return [
            'activitysystem_id'=>$activitySystemId,
            'goal'=>$this->faker->text,
            'description'=>$this->faker->text,
            'capacity'=>$this->faker->numberBetween(5,50),
            'antisepsis_date'=>$this->faker->dateTime(),
            'type'=>$this->faker->randomElement(ActivityType::cases()),
        ];
    }
}
