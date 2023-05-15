<?php

namespace Database\Factories;

use App\Models\Localidad;
use App\Models\Puerta;
use App\Models\Funcionario;
use App\Models\User;
use App\Models\Visitante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registro>
 */
class RegistroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ingresoSalida' => $this->faker->numberBetween($min = 0, $max = 1),
            'puerta' => Puerta::inRandomOrder()->first()->id,
            'visitante' => Visitante::inRandomOrder()->first()->id,
            'localidad' => Localidad::inRandomOrder()->first()->id,
            'autorizaSeguridad' => User::inRandomOrder()->first()->id,
            'autorizaFuncionario' => Funcionario::inRandomOrder()->first()->id,
            'comentario' => $this->faker->text($maxNbChars = 199)
        ];
    }
}
