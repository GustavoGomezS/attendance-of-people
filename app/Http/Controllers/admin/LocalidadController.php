<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Sector;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
  public function index()
  {
    return view('admin/ubicacion/localidad/index');
  }

  public function store(Request $request)
  {
    $arrayInputs = $request->all();
    $request->validate([
      'unidad' => ['required', 'string', 'max:9'],
      'sector' => ['required']
    ]);
    if (isset($arrayInputs['sector'])) {
      for ($i = 0; $i < count($arrayInputs['sector']); $i++) {
        $localidad = new Localidad();
        $localidad->unidad = $request->unidad;
        $localidad->sector = $arrayInputs['sector'][$i];
        $localidad->save();
      }
    }
    if ($localidad->save()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }

  public function destroy($localidad)
  {
    $localidadParaBorrar = Localidad::findOrFail($localidad);
    $resultado = $localidadParaBorrar->delete();
    if ($resultado) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }

  //consulta para rellenar el select de sector en index
  public function sectores(Sector $sectores)
  {
    $sectores = Sector::select()->get();
    return response()->json($sectores);
  }

  //listar 
  public function listar()
  {
    $datos = Localidad::select('localidad.*', 'sector.nombreSector')
      ->orderBy('sector.nombreSector', 'desc')
      ->orderBy('unidad', 'asc')
      ->from('localidad')
      ->join('sector', 'sector.id', '=', 'localidad.sector')
      ->paginate(6);
    return view('admin/ubicacion/localidad/includes/tabla')->with('datos', $datos);
  }
}