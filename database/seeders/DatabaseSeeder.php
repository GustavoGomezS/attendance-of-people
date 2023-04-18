<?php

namespace Database\Seeders;

use App\Models\Puerta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Sector;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EstadoSeeder::class,
            TipoUsuarioSeeder::class,
            PuertaSeeder::class,
            PoderAutorizarSeeder::class,
        ]);
    }

}
