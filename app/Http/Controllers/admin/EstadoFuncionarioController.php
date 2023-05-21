<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Funcionario;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EstadoFuncionarioController extends Controller
{
    public function index()
    {
        $datos = Self::datosIndex();
        return view('admin.estadoFuncionario.index')->with('datos', $datos);
    }
    private function datosIndex()
    {
        $sectores = json_decode(Sector::select('id', 'color')->orderBy('nombreSector', 'asc')->get(), true);
        $localidades = Self::getLocalidades($sectores);
        return $localidades;
    }
    private function getLocalidades($sectores)
    {
        $datos = array();
        for ($i = 0; $i < count($sectores); $i++) {
            $queryLocalidades = Localidad::select('localidad.id', DB::raw("CONCAT(sector.nombreSector,' - ', localidad.unidad) AS unidad"))
                ->from('localidad')
                ->join('sector', 'sector.id', '=', 'localidad.sector')
                ->where('sector', '=', $sectores[$i]['id'])
                ->get()->all();
            $datos[$sectores[$i]['color']] = Arr::pluck($queryLocalidades, 'unidad', 'id');
        }
        return $datos;
    }

    public function funcionarios($localidad)
    {
        $funcionarios = Funcionario::select()
            ->where([['localidad', '=', $localidad], ['estadoFuncionario', '<>', 2]])->get();
        return view('admin.estadoFuncionario.includes.tablaFuncionario')->with('datos', $funcionarios);
    }

    public function update(Request $request)
    {
        $formulario = $request->all();
        if (isset($formulario['estadoFuncionario'])) {
            DB::table('funcionario')->where('id', $request->idFuncionario)->update(['estadoFuncionario' => 3]);
            return response()->json(['success' => true]);
        } else {
            DB::table('funcionario')->where('id', $request->idFuncionario)->update(['estadoFuncionario' => 4]);
            return response()->json(['success' => true]);
        }
    }

    public function updateManual(Request $request)
    {
        $existeFuncionario = Funcionario::firstWhere('documentoFuncionario', $request->buscar);
        if ($existeFuncionario) {
            switch ($existeFuncionario->estadoFuncionario) {
                case 3:
                    $existeFuncionario->update(['estadoFuncionario' => 4]);
                    return response()->json(['success' => true]);
                case 2:
                    return response()->json(['success' => false, 'messages' => 'Este funcionario no se encuentra habilitado.']);
                default:
                    $existeFuncionario->update(['estadoFuncionario' => 3]);
                    return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['success' => false, 'messages' => 'Funcionario no registrado.']);
        }
    }
}
