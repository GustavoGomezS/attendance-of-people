<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistroRequest;
use App\Models\Puerta;
use App\Models\Registro;
use App\Models\Residente;
use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin/registro/index');
  }

  public function store(RegistroRequest $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      if ($request->ajax()) {
        DB::table('visitante')->where('id', $request->visitante)->update(['estadoVisitante' => 3, 'localidadVisita' => $request->idLocalidad]);
        $registro = new Registro();
        $registro->ingresoSalida = $request->ingresoSalida;
        $registro->puerta = $request->puerta;
        $registro->visitante = $request->visitante;
        $registro->localidad = $request->idLocalidad;
        $registro->autorizaSeguridad = $request->autorizaSeguridad;
        $registro->autorizaResidente = $request->autorizaResidente;
        $registro->comentario = $request->comentario;
        $registro->save();
        if ($registro->save()) {
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

  //consulta para rellenar el select de puerta en index
  public function puerta(Puerta $localidad)
  {
    $localidad = Puerta::select()
      ->orderBy('nombrePuerta', 'desc')
      ->get();
    return response()->json($localidad);
  }

  //consulta para rellenar el select de autoriza en index
  public function autoriza(Request $request)
  {
    $datos = Residente::where('localidad', '=', $request->localidadBusqueda)
      ->orderBy('fechaNacimientoResidente', 'asc')
      ->get();
    return response()->json($datos);
  }

  public function visitante(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $detalleVisitante = Visitante::select()
        ->where('visitante.documentoVisitante', '=', "$request->documento")
        ->get();
      /* decodifico la respuesta para modificar el campo de la foto */
      $array = json_decode($detalleVisitante, true);
      if (isset($array[0]["fotoVisitante"])) {
        $array[0]["fotoVisitante"] =  asset($array[0]["fotoVisitante"]);
        return response()->json(['success' => 'true', 'data' => $array]);
      } else {
        return response()->json(['success' => 'false', 'messages' => 'Visitante no registrado.']);
      }
    } else {
      return back();
    }
  }

  public function listarResidente(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $datos = Residente::select('residente.*', 'estados.nombreEstado')
        ->orderBy('created_at', 'desc')
        ->from('residente')
        ->join('estados', 'estados.id', '=', 'residente.estadoResidente')
        ->where([
          ["residente.localidad", '=', "$request->localidadBusqueda"]
        ])
        ->paginate(6);
      return view('admin/registro/includes/tablaResidente')->with('datos', $datos);
    } else {
      return back();
    }
  }
  public function listarRegistro(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $datos = Registro::select('registro.*', 'visitante.nombreVisitante', 'visitante.telefonoVisitante', 'residente.nombreResidente', 'estados.nombreEstado')
        ->orderBy('created_at', 'desc')
        ->from('registro')
        ->join('visitante', 'visitante.id', '=', 'registro.visitante')
        ->join('estados', 'estados.id', '=', 'visitante.estadoVisitante')
        ->leftJoin('residente', 'residente.id', '=', 'registro.autorizaResidente')
        ->where([
          ["registro.localidad", '=', "$request->localidadBusqueda"],
        ])
        ->whereBetween('registro.created_at', [date('Y-m-d') . " 00:00:00 ", date('Y-m-d') . " 23:59:59"])
        ->paginate(6);
      return view('admin/registro/includes/tablaRegistro')->with('datos', $datos);
    } else {
      return back();
    }
  }
  public function listarVisitante(Request $request)
  {
    if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
      $datos = Visitante::select('visitante.nombreVisitante', 'visitante.telefonoVisitante', 'estados.nombreEstado')
        ->from('visitante')
        ->join('estados', 'estados.id', '=', 'visitante.estadoVisitante')
        ->where([
          ["visitante.localidadVisita", '=', "$request->localidadBusqueda"],
          ['visitante.estadoVisitante', "=", "3"]
        ])->get();
      return view('admin/registro/includes/tablaVisitante')->with('datos', $datos);
    } else {
      return back();
    }
  }
}
