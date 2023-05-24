<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Registro;
use App\Models\RegistroFuncionario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('UTC');

class ReporteController extends Controller
{
    /* se creo varios array asociativos que seran accedidos por medio de la variable que envia la 
 ruta (index/{clave}), se realiza una seleccion de cada  array y se envia a la vista */
    public function index($clave)
    {
        $datosDeVista = Self::asignarDatosDeVista($clave);
        return view('admin.reporte.index')->with('datos', $datosDeVista);
    }
    private function asignarDatosDeVista($clave)
    {
        $tituloPagina = [
            "conNovedad" => "Reporte de Registros Con Novedad",
            "recinto" => "Reporte de Registros del Recinto (todos)",
            "sector" => "Reporte de Registros por Sector",
            "localidad" => "Reporte de Registros por Localidad",
            "visitante" => "Reporte de Registros por Visitante",
            "funcionario" => "Reporte de Registros de Funcionarios",
            "funcionarioTarde" => "Reporte de Llegada Tarde"
        ];
        $formularioBusqueda = [
            "conNovedad" => "admin.reporte.includes.formRangoFechas",
            "recinto" => "admin.reporte.includes.formRangoFechas",
            "sector" => "admin.reporte.includes.formSector",
            "localidad" => "admin.reporte.includes.formLocalidad",
            "visitante" => "admin.reporte.includes.formVisitante",
            "funcionario" => "admin.reporte.includes.formFuncionario",
            "funcionarioTarde" => "admin.reporte.includes.formFuncionario"
        ];
        return $datosDeVista = [
            "tituloPagina" => $tituloPagina[$clave],
            "formularioBusqueda" => $formularioBusqueda[$clave],
            "where" =>  $clave,
        ];
    }

    /* la variable $request->where es el mismo valor que viene desde la ruta (index/{clave}) que se envia 
  a la vista para cumplir algunas funciones y se envia nuevamente al controlador */
    public function reportes(Request $request)
    {
        if ($request->where == "funcionario" || $request->where == "funcionarioTarde") {
            $datos = Self::getReportesFuncionario($request);
            return response()->json(['data' => $datos]);
        } else {
            $datos = Self::getReportes($request);
            $graficas = Self::getDataGraficas($request);
            return response()->json(['data' => $datos, 'graficas' => $graficas]);
        }
    }

    private function getReportesFuncionario($request)
    {
        $where = Self::prepararWhere("normal", $request);
        $datos = RegistroFuncionario::select(
            DB::raw("CONCAT(nombreFuncionario,' ', apellidoFuncionario) AS nombreFuncionario"),
            DB::raw("CONCAT(sector.nombreSector,' - ', localidad.unidad) AS unidad"),
            DB::raw("CONCAT(registro_funcionario.fecha,' - ', registro_funcionario.hora) AS RFecha"),
            "registro_funcionario.*",
            "estados.nombreEstado"
        )
            ->from("registro_funcionario")
            ->join("estados", "estados.id", "=", "registro_funcionario.nuevoEstado")
            ->join("funcionario", "funcionario.id", "=", "registro_funcionario.funcionario")
            ->join("localidad", "localidad.id", "=", "funcionario.localidad")
            ->join("sector", "sector.id", '=', "localidad.sector")
            ->where(
                function ($query) use ($request, $where) {
                    if ($request->where == "funcionario") {
                        $query->where($where[$request->where]);
                    } else {
                        if ($request->where == "funcionarioTarde") {
                            if ($request->funcionario == null) {
                                $query->whereColumn($where[$request->where])
                                    ->where([["nuevoEstado", "=", "3"]]);
                            }
                            if ($request->funcionario != null) {
                                $query->where([['funcionario.documentoFuncionario', "=", $request->funcionario]])
                                    ->whereColumn($where[$request->where])
                                    ->where([["nuevoEstado", "=", "3"]]);
                            }
                        }
                    }
                }
            )
            ->whereBetween('registro_funcionario.fecha', [$request->fechaInicio, $request->fechaFin])
            ->get();
        return $datos;
    }

    private function getReportes($request)
    {
        $where = Self::prepararWhere("normal", $request);
        $datos = Registro::select(
            DB::raw("CONCAT(nombreVisitante,' ', apellidoVisitante) AS nombreVisitanteCompleto"),
            'visitante.*',
            'funcionario.nombreFuncionario',
            'puerta.nombrePuerta',
            'registro.*'
        )
            ->from('registro')
            ->join('visitante', 'visitante.id', '=', 'registro.visitante')
            ->leftJoin('puerta', 'puerta.id', '=', 'registro.puerta')
            ->leftJoin('funcionario', 'funcionario.id', '=', 'registro.autorizaFuncionario')
            ->leftJoin('localidad', 'localidad.id', '=', 'registro.localidad')
            ->leftJoin('sector', 'sector.id', '=', 'localidad.sector')
            ->where($where[$request->where])
            ->whereBetween('registro.created_at', [$request->fechaInicio . " 00:00:00 ", $request->fechaFin . " 23:59:59"])
            ->get();
        $datos = json_decode($datos);
        $nuevosDatos = array_map("Self::modificarDatosDeNovedades", $datos);
        return $nuevosDatos;
    }

    private function prepararWhere($tipoDeWhere, $request)
    {
        $soloIngresos = ['registro.ingresoSalida', '=', 1];
        $where = [
            "conNovedad" => [['registro.comentario', "<>", null]],
            "recinto" => [['registro.id', "<>", null]],
            "sector" => [['localidad.sector', "=", $request->sector]],
            "localidad" => [['registro.localidad', "=", $request->localidad]],
            "visitante" => [['visitante.documentoVisitante', "=", $request->visitante]],
            "funcionario" => [['funcionario.documentoFuncionario', "=", $request->funcionario]],
            "funcionarioTarde" => [['hora', ">", 'horaEntrada']],
        ];
        if ($request->funcionario == null) {
            $where["funcionario"] = [['registro_funcionario.id', "<>", null]];
        }
        if ($tipoDeWhere == "soloIngresos") {
            foreach ($where as $clave => $valor) {
                array_push($where[$clave], $soloIngresos);
            }
            return $where;
        }
        if ($tipoDeWhere == "normal") {
            return $where;
        }
    }

    private function modificarDatosDeNovedades($datos)
    {
        Self::modificarFormatoFecha($datos);
        Self::modificarUrlFoto($datos);
        Self::modificarIngresoSalida($datos);
        return $datos;
    }
    private function modificarUrlFoto($datos)
    {
        $datos->fotoVisitante = asset($datos->fotoVisitante);
    }
    private function modificarFormatoFecha($datos)
    {
        $fechaVieja = new DateTime($datos->created_at);
        $datos->created_at = $fechaVieja->format('d-m-Y H:i:s');
    }
    private function modificarIngresoSalida($datos)
    {
        if ($datos->ingresoSalida == 0) {
            $datos->ingresoSalida = "Salida";
        }
        if ($datos->ingresoSalida == 1) {
            $datos->ingresoSalida = "Entrada";
        }
    }

    public function getDataGraficas($request)
    {
        $datos = [];
        $datos["sectores"] = Self::getIngresos($request, "sector.nombreSector"); //segundo parametro = tabla.campo
        $datos["localidades"] = Self::getIngresos($request, "localidad.unidad");
        return $datos;
    }
    private function getIngresos($request, $clave)
    {
        $where = Self::prepararWhere("soloIngresos", $request);
        $data = Registro::select(
            $clave . " as unidad",
            DB::raw("COUNT(*) AS ingresos")
        )
            ->from('registro')
            ->join('visitante', 'visitante.id', '=', 'registro.visitante')
            ->leftJoin('localidad', 'localidad.id', '=', 'registro.localidad')
            ->leftJoin('sector', 'sector.id', '=', 'localidad.sector')
            ->where($where[$request->where])
            ->whereBetween('registro.created_at', [$request->fechaInicio . " 00:00:00 ", $request->fechaFin . " 23:59:59"])
            ->groupBy($clave)
            ->orderBy($clave, 'desc')
            ->get();
        return $data;
    }
}
