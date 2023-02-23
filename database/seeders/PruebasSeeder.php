<?php

namespace Database\Seeders;

use App\Models\Localidad;
use App\Models\Registro;
use App\Models\Residente;
use App\Models\Sector;
use App\Models\Visitante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::factory(4)->create();
        Localidad::factory(40)->create();
        Residente::factory(90)->create();
        Visitante::factory(300)->create();
        Registro::factory(1000)->create();
    }
}
