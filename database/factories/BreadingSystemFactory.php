<?php

namespace Database\Factories;

use App\Models\BreadingSystem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BreadingSystem>
 */
class BreadingSystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model =BreadingSystem::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'goal' => fake()->sentence(5),
            'cause_of_creation' =>fake()-> sentence(15),
            'description' =>fake()-> paragraph(),
        ];
    }
}
