<?php

namespace Database\Factories;

use App\Models\BreadingSystem;
use App\Models\Cow;
use App\Models\CowFeed;
use App\Models\FeedStock;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CowFeed>
 */
class CowFeedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model =CowFeed::class;

    public function definition(): array
    {
        $cowId=Cow::inRandomOrder()->first()->id;
        $feedStockId=FeedStock::inRandomOrder()->first()->id;
        $breadingSystemId=BreadingSystem::inRandomOrder()->first()->id;
        $userId = optional(User::inRandomOrder()->first())->id;

        return [
            'user_id' => $userId,
            'cow_id' => $cowId,
            'breadindsystem_id'=>$breadingSystemId,
            'feedstock_id' => $feedStockId,
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'actual_amount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
