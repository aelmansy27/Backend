<?php

namespace Database\Factories;

use App\Models\Purpose;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purpose>
 */
class PurposeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Purpose::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->randomElement(['milk production','fattening']),
        ];
    }
}
