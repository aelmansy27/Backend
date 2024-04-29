<?php

namespace Database\Factories;

use App\Models\Sensor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sensor>
 */
class SensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Sensor::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'type'=>$this->faker->randomElement(['temperature','heart rate','movement rate']),
            'code'=>$this->faker->text
        ];
    }
}
