<?php

namespace Database\Factories;

use App\Models\Cow;
use App\Models\MilkAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MilkAmount>
 */
class MilkAmountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=MilkAmount::class;

    public function definition(): array
    {
        $cowId=Cow::inRandomOrder()->first()->id;
        return [
            'cow_id'=>$cowId,
            'morning_amount'=>$this->faker->randomFloat(2,1,10),
            'afternoon_amount'=>$this->faker->randomFloat(2,1,10),
        ];
    }
}
