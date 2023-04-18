<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoderAutorizarSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $poderAutorizar = [
      'Si',
      'No',
      'Siempre',
    ];
    foreach ($poderAutorizar as $key => $value) {
      DB::table('poder_autorizar')->insert([
        'nombrePoder' => $value,
      ]);
    }
  }
}
