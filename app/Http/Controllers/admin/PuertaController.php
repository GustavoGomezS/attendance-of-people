<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Puerta;
use Illuminate\Http\Request;

class PuertaController extends Controller
{
  public function store(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->ajax()) {
        $request->validate([
          'nombre' => ['required', 'string', 'max:9'],
        ]);
        $puerta = new Puerta();
        $puerta->nombrepuerta = $request->nombre;
        $puerta->save();
        if ($puerta->save()) {
          return response()->json(['success' => 'true']);
        } else {
          return response()->json(['success' => 'false']);
        }
      } else {
        return "Error en el envio Ajax";
      }
    } else {
      return back();
    }
  }
  public function destroy($puerta)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $borrado = Puerta::findOrFail($puerta);
      $resultado = $borrado->delete();
      if ($resultado) {
        return response()->json(['success' => 'true']);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }
  public function listar()
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $datos = Puerta::select('*')
        ->orderBy('nombrePuerta', 'desc')
        ->from('puerta')
        ->paginate(6);
      return view('admin/ubicacion/sectorPuerta/tablas/tablaPuerta')->with('datos', $datos);
    } else {
      return back();
    }
  }
}
