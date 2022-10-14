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
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $arrayInputs = $request->all();
      if ($request->ajax()) {
        $request->validate([
          'unidad' => ['required', 'string', 'max:9'],
          'sector' => ['required']
        ]);
        if (isset($arrayInputs['unidad'])) {
          for ($i = 0; $i < count($arrayInputs['sector']); $i++) {
            $localidad = new Localidad();
            $localidad->unidad = $request->unidad;
            $localidad->sector = $arrayInputs['sector'][$i];
            $localidad->save();
          }
        }

        if ($localidad->save()) {
          return response()->json(['success' => 'true']);
        } else {
          return response()->json(['success' => 'false']);
        }
      } else {
        return back();
      }
    } else {
      return back();
    }
  }
  public function destroy($localidad)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $borrado = Localidad::findOrFail($localidad);
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
  //consulta para rellenar el select de sector en index
  public function checkSector(Sector $checkSector)
  {
    $checkSector = Sector::select('sector.*')
      ->from('sector')
      ->get();
    return response()->json($checkSector);
  }
  //listar 
  public function listar()
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $datos = Localidad::select('localidad.*', 'sector.nombreSector')
        ->orderBy('sector.nombreSector', 'desc')
        ->orderBy('unidad', 'asc')
        ->from('localidad')
        ->join('sector', 'sector.id', '=', 'localidad.sector')
        ->paginate(6);
      return view('admin/ubicacion/localidad/includes/tabla')->with('datos', $datos);
    } else {
      return back();
    }
  }
}
