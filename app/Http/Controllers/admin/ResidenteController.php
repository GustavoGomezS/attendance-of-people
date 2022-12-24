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
  public function index()
  {
    return view('admin/Residente/index');
  }

  public function store(ResidenteRequest $request){
    $request->validate(['fotoResidente' => 'required|']);
    $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoResidente'));
    $guardaConExito = Self::GuardarResidente($nombreImagen, $request);
    if ($guardaConExito) {
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
  private function GuardarResidente($nombreImagen, $request){
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
    } else {
      return false;
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
    $formulario = $request->all();
    if ($request->hasFile('fotoResidente')) {
      Self::eliminarFotoDelStorage($residente->fotoResidente);
      $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoResidente'));
      $formulario["fotoResidente"] = '/storage/imagenes/' . $nombreImagen; //url para la BD
    }
    $actualizaCorrectamente = $residente->fill($formulario)->save();
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

  public function edit($Residente){
    $residente = Residente::findOrFail($Residente);
    $residente->fotoResidente = asset($residente->fotoResidente); //agrego direccion url de la foto
    if ($residente) {
    return response()->json(['success' => true, 'data' => $residente]);
    } else {
    return response()->json(['success' => false]);
    }
  }

  //consulta para rellenar el select de sectorBusqueda en index
  public function sectores(Sector $sectores)
  {
    $sectores = Sector::select()->orderBy('sector.nombreSector', 'asc')->get();
    return response()->json($sectores);
  }

  //consulta para rellenar el select de sectorBusqueda en index
  public function localidades(Request $request)
  {
    $datos = Localidad::select('localidad.*', 'sector.color')
      ->where('localidad.sector', '=', $request->sector)
      ->orderBy('localidad.unidad', 'asc')
      ->join('sector', 'sector.id', '=', 'localidad.sector')
      ->get();
    return response()->json($datos);
  }

  public function listar(Request $request)
  {
    if ($request->filtro != "0" && $request->buscar != "") {
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
      return view('admin/residente/includes/tabla')->with('datos', $datos);
    } else {
      $datos = Residente::select('residente.*', 'estados.nombreEstado', 'sector.nombreSector', 'localidad.unidad')
        ->orderBy('created_at', 'desc')
        ->from('residente')
        ->join('estados', 'estados.id', '=', 'residente.estadoResidente')
        ->leftJoin('localidad', 'localidad.id', '=', 'residente.localidad')
        ->leftJoin('sector', 'sector.id', '=', 'localidad.sector')
        ->paginate(6);
      return view('admin/residente/includes/tabla')->with('datos', $datos);
    }

  }
}