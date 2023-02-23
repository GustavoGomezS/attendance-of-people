<?php

namespace Database\Factories;

use App\Models\Localidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Residente>
 */
class ResidenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'documentoResidente' => $this->faker->unique()->numberBetween($min = 1096000000, $max =1999000000),
            'nombreResidente'=> $this->faker->firstName('male'|'female'),
            'apellidoResidente' => $this->faker->lastName(),
            'fotoResidente' => '/storage/imagenes/oqPGW20230218132039Alan.png',
            'localidad' => Localidad::inRandomOrder()->first()->id,
            'telefonoResidente' =>	$this->faker->e164PhoneNumber(),
            'estadoResidente' => $this->faker->randomElement($array = array (1,3,4)),
            'sexoResidente' => $this->faker->randomElement($array = array ('H','M')),
            'fechaNacimientoResidente'=>$this->faker->dateTimeThisCentury($max = 'now', $timezone = null)
        ];
    }
}
