<?php

namespace Database\Factories;

use App\Models\FeedStock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeedStock>
 */
class FeedStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model =FeedStock::class;
    public function definition(): array
    {

        return [
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'manufacturing_date' => $this->faker->dateTimeThisYear,
            'manufacturing_code' => $this->faker->regexify('[A-Z0-9]{10}'),
            'validation_period' => $this->faker->dateTimeBetween('now', '+1 year'),
            'producer' => $this->faker->company,
            'amount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
