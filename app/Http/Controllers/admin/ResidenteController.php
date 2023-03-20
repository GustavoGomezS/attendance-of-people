<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResidenteRequest;
use App\Models\Localidad;
use App\Models\Residente;
use App\Models\Sector;
use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ResidenteController extends Controller
{
  public function index(){
    return view('admin.residente.index');
  }
  public function hola(){
    return "hola";
  }

  public function store(ResidenteRequest $request){
    $request->validate(['fotoResidente' => 'required|']);
    $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoResidente'));
    $guardaCorrectamente = Self::residenteNuevo($nombreImagen, $request);
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
  private function residenteNuevo($nombreImagen, $request){
    $residente = new Residente();
    $residente->documentoResidente = $request->documentoResidente;
    $residente->nombreResidente = $request->nombreResidente;
    $residente->apellidoResidente = $request->apellidoResidente;
    $residente->fotoResidente = '/storage/imagenes/' . $nombreImagen; //guardo la url en la bd
    $residente->localidad = $request->localidad;
    $residente->estadoResidente = 3;
    $residente->telefonoResidente = $request->telefonoResidente;
    $residente->sexoResidente = $request->sexoResidente;
    $residente->fechaNacimientoResidente = $request->fechaNacimientoResidente;
    $residente->save();
    if ($residente->save()) {
      return true;
    }
  }

  public function desactivar(Residente $Residente){
    if ($Residente->estadoResidente == 3 || $Residente->estadoResidente == 4) {
      $Residente->update(['estadoResidente' => 2]);
    }else {
      $Residente->update(['estadoResidente' => 3]);
    }
    if ($Residente->update()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }

  public function update(ResidenteRequest $request,Residente $residente,){
    $nuevosDatos = $request->all();
    if ($request->hasFile('fotoResidente')) {
      Self::eliminarFotoDelStorage($residente->fotoResidente);
      $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoResidente'));
      $nuevosDatos["fotoResidente"] = '/storage/imagenes/' . $nombreImagen; //url para la BD
    }
    $actualizaCorrectamente = $residente->fill($nuevosDatos)->save();
    if ($actualizaCorrectamente) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  private function eliminarFotoDelStorage($urlFotoResidente){
    $url = str_replace('storage', 'public', $urlFotoResidente);
    Storage::delete($url);
  }

  public function edit($id){
    $existeResidente = Residente::findOrFail($id);
    $existeResidente->fotoResidente = asset($existeResidente->fotoResidente); //agrego direccion url de la foto
    if ($existeResidente) {
      return response()->json(['success' => true, 'data' => $existeResidente]);
    } else {
      return response()->json(['success' => false]);
    }
  }

  //consulta para rellenar el select de sectorBusqueda en index
  public function sectores(Sector $sectores){
    $sectores = Sector::select()->orderBy('sector.nombreSector', 'asc')->get();
    return response()->json($sectores);
  }

  //consulta para rellenar el select de sectorBusqueda en index
  public function localidades(Request $request){
    $datos = Self::getLocalidades($request);
    return response()->json($datos);
  }
  private function getLocalidades($request){
    $datos = Localidad::select('localidad.*', 'sector.color')
      ->where('localidad.sector', '=', $request->sector)
      ->orderBy('localidad.unidad', 'asc')
      ->join('sector', 'sector.id', '=', 'localidad.sector')
      ->get();
    return $datos;
  }

  public function listar(Request $request){
    if ($request->filtro != "0" && $request->buscar != "") {
      $datos = Self::getResidentes($request);
      return view('admin.residente.includes.tabla')->with('datos', $datos);
    } 
  }
  private function getResidentes($request){
    $datos = Residente::select('residente.*', 'estados.nombreEstado', 'sector.nombreSector', 'localidad.unidad')
      ->orderBy('created_at', 'desc')
      ->from('residente')
      ->join('estados', 'estados.id', '=', 'residente.estadoResidente')
      ->leftJoin('localidad', 'localidad.id', '=', 'residente.localidad')
      ->leftJoin('sector', 'sector.id', '=', 'localidad.sector')
      ->where([
        ["$request->filtro", 'LIKE', "$request->buscar%"]
      ])
      ->paginate(6);
    return $datos;
  }
}