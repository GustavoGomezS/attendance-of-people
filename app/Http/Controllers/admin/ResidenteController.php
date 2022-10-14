<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResidenteRequest;
use App\Models\Localidad;
use App\Models\Residente;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ResidenteController extends Controller
{

  public function index()
  {
    return view('admin/Residente/index');
  }

  public function create()
  {
    //
  }

  public function store(ResidenteRequest $request)
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
        $residente = new Residente();
        $residente->documentoResidente = $request->documentoResidente;
        $residente->nombreResidente = $request->nombreResidente;
        $residente->apellidoResidente = $request->apellidoResidente;
        $residente->fotoResidente = '/storage/imagenes/' . $nombre; //guardo la url en la bd
        $residente->localidad = $request->localidad;
        $residente->telefonoResidente = $request->telefonoResidente;
        $residente->estadoResidente = $request->estadoResidente;
        $residente->sexoResidente = $request->sexoResidente;
        $residente->fechaNacimientoResidente = $request->fechaNacimientoResidente;
        $residente->save();
        if ($residente->save()) {
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

  public function show(Residente $Residente)
  {
    //
  }

  public function edit($Residente)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $detalleResidente = Residente::select()
        ->from('residente')
        ->where('residente.id', '=', "$Residente")
        ->get();
      /* decodifico la respuesta para modificar el campo de la foto */
      $array = json_decode($detalleResidente, true);
      $array[0]["fotoResidente"] =  asset($array[0]["fotoResidente"]);
      if ($detalleResidente) {
        return response()->json(['success' => 'true', 'data' => $array]);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }

  public function update(ResidenteRequest $request, Residente $Residente)
  {
    $formulario = $request->all();
    if ($request->hasFile('fotoResidente')) {
      /* elimino la imagen anterior */
      $url = str_replace('storage', 'public', $Residente->fotoResidente);
      Storage::delete($url);
      /* cargar imagenes con plugin para redimencionar imagenes */
      /* al nombre original del archivo le agrego 10 caracteres random */
      $nombre = Str::Random(5) . date('YmdHis') . $request->file('fotoResidente')->getClientOriginalName();
      /* selecciono la ruta donde queda guardada la imagen con su nombre */
      $urlNuevo = storage_path() . '\app\public\imagenes/' . $nombre;
      /*   redimenciono y  guardo en el servidor independientedel guardado en la bd */
      Image::make($request->file('fotoResidente'))->resize(300, 200)->save($urlNuevo);
      $formulario["fotoResidente"] = '/storage/imagenes/' . $nombre; //guardo la url en la bd
    }

    $resultado = $Residente->fill($formulario)->save();

    if ($resultado) {
      return response()->json(['success' => 'true']);
    } else {
      return response()->json(['success' => 'false']);
    }
  }

  public function destroy(Residente $Residente)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      /* Elimino archivo del servidor */
      $url = str_replace('storage', 'public', $Residente->fotoResidente);
      Storage::delete($url);
      /* Elimino registro de la bd */

      $resultado = $Residente->delete();
      if ($resultado) {
        return response()->json(['success' => 'true']);
      } else {
        return response()->json(['success' => 'false']);
      }
    } else {
      return back();
    }
  }

  //consulta para rellenar el select de sectorBusqueda en index
  public function sectorBusqueda(Sector $localidad)
  {
    $localidad = Sector::select()
      ->orderBy('sector.nombreSector', 'asc')
      ->get();
    return response()->json($localidad);
  }
  //consulta para rellenar el select de sectorBusqueda en index
  public function localidadBusqueda(Request $request)
  {
    $datos = Localidad::where('localidad.sector', '=', $request->sector)
      ->orderBy('localidad.unidad', 'asc')
      ->get();
    return response()->json($datos);
  }
  public function listar(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $datos = Localidad::select('residente.*', 'estados.nombreEstado', 'sector.nombreSector', 'localidad.unidad')
        ->orderBy('created_at', 'desc')
        ->from('residente')
        ->join('estados', 'estados.id', '=', 'residente.estadoResidente')
        ->join('localidad', 'localidad.id', '=', 'residente.localidad')
        ->join('sector', 'sector.id', '=', 'localidad.sector')
        ->where([
          ["residente.localidad", '=', "$request->localidadBusqueda"]
        ])
        ->paginate(6);
      return view('admin/residente/includes/tabla')->with('datos', $datos);
    } else {
      return back();
    }
  }
}
