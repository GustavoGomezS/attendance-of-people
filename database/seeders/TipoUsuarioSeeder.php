<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tipo_usuario = [
      'Admin',
      'Guarda',
    ];
    foreach ($tipo_usuario as $key => $value) {
      DB::table('tipo_usuario')->insert([
        'nombreTipoUsuario' => $value,
      ]);
    }
  }
}
