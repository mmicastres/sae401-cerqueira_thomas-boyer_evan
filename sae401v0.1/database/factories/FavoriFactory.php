<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Favori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Favori>
 */
class FavoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "idcitation" => $this->faker->numberBetween(0, 10),
            "idutilisateur" => $this->faker->numberBetween(0, 10),
        ];
    }
}
