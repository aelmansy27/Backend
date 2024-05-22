<?php

namespace Database\Factories;

use App\Models\Cow;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cowId=Cow::inRandomOrder()->first()->id;

        return [
            'note_id' => $this->faker->unique()->regexify('[A-Za-z0-9]{5}'),
            'cow_id' => $cowId,
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'is_starred' => $this->faker->boolean(false)

        ];
    }
}
