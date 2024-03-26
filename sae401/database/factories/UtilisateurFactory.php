<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idinventaire' => $this->faker->unique()->numberBetween(0, 10),
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'motdepasse' => password_hash($this->faker->password, PASSWORD_DEFAULT),
            'pieces' => $this->faker->numberBetween(0, 100),
        ];
    }
}
