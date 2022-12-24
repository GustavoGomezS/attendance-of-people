<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitanteRequest;
use App\Models\Registro;
use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class VisitanteController extends Controller
{

  public function index()
  {
    return view('admin/visitante/index');
  }


  public function store(VisitanteRequest $request)
  {
    $request->validate([
      'foto' => 'required|',
    ]);
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      /* cargar imagenes con plugin para redimencionar imagenes */
      /* al nombre original del archivo le agrego 10 caracteres random */
      $nombre = Str::Random(5) . date('YmdHis') . $request->file('foto')->getClientOriginalName();
      /* selecciono la ruta donde queda guardada la imagen con su nombre */
      $url = storage_path() . '\app\public\imagenes/' . $nombre;
      /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
      Image::make($request->file('foto'))->resize(300, 200)->save($url);
      if ($request->ajax()) {
        $visitante = new Visitante();
        $visitante->documentoVisitante = $request->documentoVisitante;
        $visitante->nombreVisitante = $request->nombreVisitante;
        $visitante->apellidoVisitante = $request->apellidoVisitante;
        $visitante->fotoVisitante = '/storage/imagenes/' . $nombre; //guardo la url en la bd
        $visitante->telefonoVisitante = $request->telefonoVisitante;
        $visitante->sexoVisitante = $request->sexoVisitante;
        $visitante->estadoVisitante = 4;
        $visitante->localidadVisita = null;
        $visitante->fechaNacimientoVisitante = $request->fechaNacimientoVisitante;
        $visitante->save();
        if ($visitante->save()) {
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

  public function edit($visitante)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $detalleVisitante = Visitante::select()
        ->where('visitante.id', '=', "$visitante")
        ->get();
      /* decodifico la respuesta para modificar el campo de la foto */
      $array = json_decode($detalleVisitante, true);
      $array[0]["fotoVisitante"] =  asset($array[0]["fotoVisitante"]);
      if ($detalleVisitante) {
        return response()->json(['success' => 'true', 'data' => $array]);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }

  public function update(VisitanteRequest $request, Visitante $visitante)
  {
    $formulario = $request->all();
    if ($request->hasFile('fotoVisitante')) {
      /* elimino la imagen anterior */
      $url = str_replace('storage', 'public', $visitante->fotoVisitante);
      Storage::delete($url);
      /* cargar imagenes con plugin para redimencionar imagenes */
      /* al nombre original del archivo le agrego 10 caracteres random */
      $nombre = Str::Random(5) . date('YmdHis') . $request->file('fotoVisitante')->getClientOriginalName();
      /* selecciono la ruta donde queda guardada la imagen con su nombre */
      $urlNuevo = storage_path() . '\app\public\imagenes/' . $nombre;
      /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
      Image::make($request->file('fotoVisitante'))->resize(300, 200)->save($urlNuevo);
      $formulario["fotoVisitante"] = '/storage/imagenes/' . $nombre; //guardo la url en la bd
    }

    $resultado = $visitante->fill($formulario)->save();

    if ($resultado) {
      return response()->json(['success' => 'true']);
    } else {
      return response()->json(['success' => 'false']);
    }
  }

  public function destroy(Visitante $visitante)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      /* Elimino archivo del servidor */
      $url = str_replace('storage', 'public', $visitante->fotoVisitante);
      Storage::delete($url);
      /* Elimino registro de la bd */

      $resultado = $visitante->delete();
      if ($resultado) {
        return response()->json(['success' => 'true']);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }

  public function listar(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->filtro != "0" && $request->buscar != "") {
        $datos = Visitante::select('visitante.*', 'estados.nombreEstado')
          ->orderBy('created_at', 'desc')
          ->from('visitante')
          ->join('estados', 'estados.id', '=', 'visitante.estadoVisitante')
          ->where([
            ["$request->filtro", 'LIKE', "$request->buscar%"]
          ])
          ->paginate(6);
        return view('admin/visitante/includes/tabla')->with('datos', $datos);
      } else {
        $datos = Visitante::select('visitante.*', 'estados.nombreEstado')
          ->orderBy('created_at', 'desc')
          ->from('visitante')
          ->join('estados', 'estados.id', '=', 'visitante.estadoVisitante')
          ->paginate(6);
        return view('admin/visitante/includes/tabla')->with('datos', $datos);
      }
    } else {
      return back();
    }
  }
  
  public function dentro()
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      return view('admin/darSalida/index');
    } else {
      return back();
    }
  }

  public function buscar()
  {
    $datos = Visitante::select(DB::raw("CONCAT(nombreVisitante,' ', apellidoVisitante) AS nombreVisitante"), 'visitante.documentoVisitante', 'visitante.id as DT_RowId', 'visitante.telefonoVisitante', DB::raw("CONCAT(nombreSector,' - ',unidad) AS sectorUnidad"),)
      ->from('visitante')
      ->join('localidad', 'localidad.id', '=', 'visitante.localidadVisita')
      ->join('sector', 'sector.id', '=', 'localidad.sector')
      ->where([
        ['visitante.estadoVisitante', "=", "3"]
      ])->get();

    return response()->json(['data' => $datos]);
  }

  public function darSalida(Request $request)
  {
    $arrayInputs = $request->all();
    if (isset($arrayInputs['id'])) {
      VisitanteController::procesoDeSalida($arrayInputs);
      return response()->json(['success' => true]);
    }
  }
  private function procesoDeSalida($arrayInputs)
  {
    for ($i = 0; $i < count($arrayInputs['id']); $i++) {
      $visitante = Visitante::findOrFail($arrayInputs['id'][$i]);
      VisitanteController::crearRegistroDeSalida($visitante, $arrayInputs,$i);
      $visitante->update(['estadoVisitante' => 4, 'localidadVisita' =>null]);
    }
  }
  private function crearRegistroDeSalida($visitante,$arrayInputs,$i)
  {
    $registro = new Registro();
    $registro->ingresoSalida = $arrayInputs['ingresoSalida'];
    $registro->visitante = $arrayInputs['id'][$i];
    $registro->autorizaSeguridad = auth()->user()->id;
    $registro->autorizaResidente = null;
    $registro->localidad = $visitante->localidadVisita;
    $registro->comentario = $arrayInputs['comentario'];
    $registro->ingresoSalida = $arrayInputs['ingresoSalida'];
    $registro->puerta = $arrayInputs['puerta'];
    $registro->save();
  }
}
