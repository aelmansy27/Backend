<?php

namespace Database\Factories;

use App\Models\Treatment;
use App\Models\TreatmentDoseTimes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TreatmentDoseTimesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=TreatmentDoseTimes::class;
    public function definition(): array
    {
        return [
            'treatment_id'=>Treatment::factory(),
            'date'=>$this->faker->date(),
            'time'=>$this->faker->time(),
            'is_taken'=>$this->faker->boolean
        ];
    }
}
