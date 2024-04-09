<?php

namespace Database\Factories;

use App\Models\Cow;
use App\Models\Treatment;
use App\Models\TreatmentDoseTimes;
use App\Models\TreatmentStock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Treatment::class;
    public function definition(): array
    {
        return [
            'cow_id' => Cow::inRandomOrder()->first()->id,
            'treatmentstock_id' => TreatmentStock::inRandomOrder()->first()->id,
            'disease' => $this->faker->sentence(),
            'doses' => $this->faker->randomFloat(2, 0, 100), // Example random decimal between 0 and 100
            'diagnose' => $this->faker->paragraph(),
            'method' => $this->faker->word(),
        ];
    }
}
