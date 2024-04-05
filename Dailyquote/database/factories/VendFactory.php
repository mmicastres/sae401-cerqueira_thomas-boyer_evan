<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vend>
 */
class VendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "iditem" => $this->faker->numberBetween(0, 10),
            "idmagasin" => $this->faker->numberBetween(1,1),
        ];
    }
}
