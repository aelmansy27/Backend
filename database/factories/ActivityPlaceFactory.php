<?php

namespace Database\Factories;

use App\Enums\ActivityType;
use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
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
        $activitySystemId=ActivitySystem::factory();
        return [
            'activitysystem_id'=>$activitySystemId,
            'name'=>$this->faker->name,
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
