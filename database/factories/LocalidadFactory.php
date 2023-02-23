<?php

namespace Database\Factories;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Localidad>
 */
class LocalidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'unidad' => $this->faker->unique()->numerify('Unidad ###'),
            'sector' => Sector::inRandomOrder()->first()->id
        ];
    }
}
