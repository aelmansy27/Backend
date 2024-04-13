<?php

namespace Database\Factories;

use App\Models\TreatmentStock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TreatmentStock>
 */
class TreatmentStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=TreatmentStock::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['tablet', 'liquid', 'others']),
            'manufacturing_date' => $this->faker->dateTimeThisMonth(),
            'manufacturing_code' => $this->faker->unique()->randomNumber(),
            'validation_period' => $this->faker->dateTimeThisYear(),
            'entrance_date' => $this->faker->dateTimeThisYear(),
            'efficiency' => $this->faker->randomFloat(2, 0, 100), // Assuming percentage
            'producer' => $this->faker->company(),
            'amount' => $this->faker->numberBetween(10, 100),
        ];
    }
}
