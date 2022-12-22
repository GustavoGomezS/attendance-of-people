<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Puerta;
use Illuminate\Http\Request;

class PuertaController extends Controller
{
  public function store(Request $request)
  {
    $request->validate(['nombre' => ['required', 'string', 'max:9']]);
    $puerta = new Puerta();
    $puerta->nombrepuerta = $request->nombre;
    $puerta->save();
    if ($puerta->save()) {
      return response()->json(['success' => true]);
    }
  }

  public function destroy($puerta)
  {
    $borrado = Puerta::findOrFail($puerta);
    $resultado = $borrado->delete();
    if ($resultado) {
      return response()->json(['success' => true]);
    }
  }

  public function listar()
  {
    $datos = Puerta::select()->orderBy('nombrePuerta', 'desc')->get();
    return view('admin/ubicacion/sectorPuerta/tablas/tablaPuerta')->with('datos', $datos);
  }
}