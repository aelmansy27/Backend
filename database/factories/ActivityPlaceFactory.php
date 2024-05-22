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
            'image'=>$this->faker->imageUrl(),
            'goal'=>$this->faker->text,
            'description'=>$this->faker->text,
            'capacity'=>$this->faker->numberBetween(5,50),
            'type'=>$this->faker->randomElement(ActivityType::cases()),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
