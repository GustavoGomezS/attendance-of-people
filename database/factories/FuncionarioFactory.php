<?php

namespace Database\Factories;

use App\Models\Localidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'documentoFuncionario' => $this->faker->unique()->numberBetween($min = 1096000000, $max =1999000000),
            'nombreFuncionario'=> $this->faker->firstName('male'|'female'),
            'apellidoFuncionario' => $this->faker->lastName(),
            'fotoFuncionario' => '/storage/imagenes/oqPGW20230218132039Alan.png',
            'localidad' => Localidad::inRandomOrder()->first()->id,
            'telefonoFuncionario' =>	$this->faker->e164PhoneNumber(),
            'estadoFuncionario' => $this->faker->randomElement($array = array (1,3,4)),
            'poderAutorizar' => $this->faker->randomElement($array = array (1,2,3)),
            'sexoFuncionario' => $this->faker->randomElement($array = array ('H','M')),
            'fechaNacimientoFuncionario'=>$this->faker->dateTimeThisCentury($max = 'now', $timezone = null)
        ];
    }
}
