<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'rol' => $this->faker->randomElement(['1', '2']),
            'estado' => $this->faker->randomElement(['0', '1'])
        ];
    }
}
