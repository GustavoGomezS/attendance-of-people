<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
  public function store(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->ajax()) {
        $request->validate([
          'nombre' => ['required', 'string', 'max:19'],
        ]);
        $sector = new Sector();
        $sector->nombreSector = $request->nombre;
        $sector->color = $request->color;
        $sector->save();
        if ($sector->save()) {
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
  public function destroy($sector)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $borrado = Sector::findOrFail($sector);
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
      $datos = Sector::select('*')
        ->orderBy('nombreSector', 'desc')
        ->from('sector')
        ->paginate(6);
      return view('admin/ubicacion/sectorPuerta/tablas/tablaSector')->with('datos', $datos);
    } else {
      return back();
    }
  }
}
