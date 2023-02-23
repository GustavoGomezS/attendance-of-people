<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use App\Models\Residente;
use App\Models\Visitante;
use App\Models\Localidad;
use Illuminate\Http\Request;

class EstadoActualController extends Controller
{
  public function index()
  {
    $matriz = Self::crearArrayDePersonasDentro();
    return view('admin.estadoActual.index')->with('datos', $matriz);
  }
  private function crearArrayDePersonasDentro()
  {
    $matriz = Self::agregarSectoresYLocalidades();
    $matriz = Self::agregarCantidadDePersonas($matriz);
    return $matriz;
  }
  private function agregarSectoresYLocalidades()
  {
    $matriz =  array();
    $sectores = Sector::OrderBy('nombreSector', 'asc')->get();
    foreach ($sectores as $numRegistro => $sector) {
      $matriz[$sector->nombreSector . $sector->color] = json_decode(
        Localidad::where('sector', '=', $sector->id)->get(),
        true
      );
    }
    return $matriz;
  }
  private function agregarCantidadDePersonas($matriz)
  {
    foreach ($matriz as $sector => $unidad) {
      for ($i = 0; $i < count($unidad); $i++) {
        $personasDentro = Self::contarPersonasDentroPor($unidad[$i]["id"]);
        $matriz[$sector] += [$unidad[$i]["unidad"] => $personasDentro];
        unset($matriz[$sector][$i]);
      }
    }
    return $matriz;
  }
  private function contarPersonasDentroPor($Unidad)
  {
    $cantidadResidentesDentro = Residente::where([['localidad', '=', $Unidad], ['estadoResidente', '=', 3]])->count();
    $cantidadVisitantesDentro = Visitante::where([['localidadVisita', '=', $Unidad], ['estadoVisitante', '=', 3]])->count();
    return $cantidadResidentesDentro + $cantidadVisitantesDentro;
  }
}
