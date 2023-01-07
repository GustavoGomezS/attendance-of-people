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
  public function index(){
    return view('admin.visitante.index');
  }

  public function store(VisitanteRequest $request){
    $request->validate(['fotoVisitante' => 'required']);
    $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoVisitante'));
    $guardaCorrectamente = Self::visitanteNuevo($nombreImagen, $request);
    if ($guardaCorrectamente) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  private function GuardarYObtenerNombreDeImagen($foto){
    $nuevoNombreImagen = Str::Random(5) . date('YmdHis') . $foto->getClientOriginalName();
    $url = storage_path() . '\app\public\imagenes/' . $nuevoNombreImagen;//url de storage para la imagen
    Image::make($foto)->resize(300, 200)->save($url);
    return $nuevoNombreImagen;
  }
  private function visitanteNuevo($nombreImagen, $request){
    $visitante = new Visitante();
    $visitante->documentoVisitante = $request->documentoVisitante;
    $visitante->nombreVisitante = $request->nombreVisitante;
    $visitante->apellidoVisitante = $request->apellidoVisitante;
    $visitante->fotoVisitante = '/storage/imagenes/' . $nombreImagen; //guardo la url en la bd
    $visitante->telefonoVisitante = $request->telefonoVisitante;
    $visitante->sexoVisitante = $request->sexoVisitante;
    $visitante->estadoVisitante = 4;
    $visitante->localidadVisita = null;
    $visitante->fechaNacimientoVisitante = $request->fechaNacimientoVisitante;
    $visitante->save();
    if ($visitante->save()) {
      return true;
    }
  }

  public function edit($id){
    $existeVisitante = Visitante::findOrFail($id);
    $existeVisitante->fotoVisitante = asset($existeVisitante->fotoVisitante); //agrego direccion url de la foto
    if ($existeVisitante) {
    return response()->json(['success' => true, 'data' => $existeVisitante]);
    } else {
    return response()->json(['success' => false]);
    }
  }

  public function update(VisitanteRequest $request, Visitante $visitante){
    $nuevosDatos = $request->all();
    if ($request->hasFile('fotoVisitante')) {
      Self::eliminarFotoDelStorage($visitante->fotoVisitante);
      $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoVisitante'));
      $nuevosDatos["fotoVisitante"] = '/storage/imagenes/' . $nombreImagen; //url para la BD
    }
    $actualizaCorrectamente = $visitante->fill($nuevosDatos)->save();
    if ($actualizaCorrectamente) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  private function eliminarFotoDelStorage($urlFoto){
    $url = str_replace('storage', 'public', $urlFoto);
    Storage::delete($url);
  }

  public function desactivar(Visitante $Visitante){
    if ($Visitante->estadoVisitante == 3 || $Visitante->estadoVisitante == 4) {
      $Visitante->update(['estadoVisitante' => 2]);
    }else {
      $Visitante->update(['estadoVisitante' => 3]);
    }
    if ($Visitante->update()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function destroy(Visitante $visitante)
  {
      /* Elimino archivo del servidor */
      $url = str_replace('storage', 'public', $visitante->fotoVisitante);
      Storage::delete($url);
      /* Elimino registro de la bd */

      $resultado = $visitante->delete();
      if ($resultado) {
        return response()->json(['success' => true]);
      } else {
        return response()->json(['success' => false]);
      }
    
  }

  public function listar(Request $request){
    if ($request->filtro != "0" && $request->buscar != "") {
      $datos = Self::getVisitantes($request);
      return view('admin.visitante.includes.tabla')->with('datos', $datos);
    } 
  }
  private function getVisitantes($request){
    $datos = Visitante::select('visitante.*', 'estados.nombreEstado')
      ->orderBy('created_at', 'desc')
      ->from('visitante')
      ->join('estados', 'estados.id', '=', 'visitante.estadoVisitante')
      ->where([["$request->filtro", 'LIKE', "$request->buscar%"]])
      ->paginate(6);
    return $datos;
  }
}