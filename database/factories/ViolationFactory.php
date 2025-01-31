<?php

namespace Database\Factories;

use App\Models\License;
use App\Models\Violation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Violation>
 */
class ViolationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->word,
            'penalty' => $this->faker->sentence(),
            'license_id' => License::factory(),
        ];
    }
}
