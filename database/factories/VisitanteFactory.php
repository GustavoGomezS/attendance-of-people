<?php

namespace Database\Factories;

use App\Models\Localidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitante>
 */
class VisitanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $estado = $this->faker->numberBetween($min = 1, $max = 4);
        $comentario = ['comentarioVisitante' => $this->faker->text($maxNbChars = 199)];
        $localidadVisita = ['localidadVisita' => Localidad::inRandomOrder()->first()->id,];
        $datos = [
            'documentoVisitante' => $this->faker->unique()->numberBetween($min = 1096000000, $max =1999000000),
            'nombreVisitante' => $this->faker->firstName('male'|'female'),
            'apellidoVisitante' => $this->faker->lastName(),
            'fotoVisitante' => '/storage/imagenes/D9UA520230218141351IMG_20170112_065015917.jpg',
            'telefonoVisitante' => $this->faker->e164PhoneNumber(),
            'estadoVisitante' => $estado,
            'sexoVisitante' => $this->faker->randomElement($array = array ('H','M')),
            'fechaNacimientoVisitante' => $this->faker->dateTimeThisCentury($max = 'now', $timezone = null),
        ];
        switch ($estado) {
            case '2':
                $datos += $comentario;
                return $datos;
                break;
            case '3':
                $datos += $localidadVisita;
                return $datos;
                break;
            default:
                return $datos;
                break;
        }
    }
}
