<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use App\Http\Requests\FuncionarioRequest;
use App\Models\Localidad;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class FuncionarioController extends Controller
{
    public function index()
    {
        return view('admin.funcionario.index');
    }

    public function store(FuncionarioRequest $request)
    {
        $request->validate(['fotoFuncionario' => 'required|']);
        $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoFuncionario'));
        $guardaCorrectamente = Self::funcionarioNuevo($nombreImagen, $request);
        if ($guardaCorrectamente) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    private function GuardarYObtenerNombreDeImagen($foto)
    {
        $nuevoNombreImagen = Str::Random(5) . date('YmdHis') . $foto->getClientOriginalName();
        $url = storage_path() . '\app\public\imagenes/' . $nuevoNombreImagen; //url de storage para la imagen
        Image::make($foto)->resize(300, 200)->save($url);
        return $nuevoNombreImagen;
    }
    private function funcionarioNuevo($nombreImagen, $request)
    {
        $funcionario = new Funcionario();
        $funcionario->documentoFuncionario = $request->documentoFuncionario;
        $funcionario->nombreFuncionario = $request->nombreFuncionario;
        $funcionario->apellidoFuncionario = $request->apellidoFuncionario;
        $funcionario->fotoFuncionario = '/storage/imagenes/' . $nombreImagen; //guardo la url en la bd
        $funcionario->localidad = $request->localidad;
        $funcionario->estadoFuncionario = 3;
        $funcionario->poderAutorizar = $request->poderAutorizar;
        $funcionario->telefonoFuncionario = $request->telefonoFuncionario;
        $funcionario->sexoFuncionario = $request->sexoFuncionario;
        $funcionario->fechaNacimientoFuncionario = $request->fechaNacimientoFuncionario;
        $funcionario->horaEntrada = $request->horaEntrada;
        $funcionario->horaSalida = $request->horaSalida;
        $funcionario->save();
        if ($funcionario->save()) {
            return true;
        }
    }

    public function desactivar(Funcionario $funcionario)
    {
        if ($funcionario->estadoFuncionario == 3 || $funcionario->estadoFuncionario == 4) {
            $funcionario->update(['estadoFuncionario' => 2]);
        } else {
            $funcionario->update(['estadoFuncionario' => 3]);
        }
        if ($funcionario->update()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function update(FuncionarioRequest $request, Funcionario $funcionario,)
    {
        $nuevosDatos = $request->all();
        if ($request->hasFile('fotoFuncionario')) {
            Self::eliminarFotoDelStorage($funcionario->fotoFuncionario);
            $nombreImagen = Self::GuardarYObtenerNombreDeImagen($request->file('fotoFuncionario'));
            $nuevosDatos["fotoFuncionario"] = '/storage/imagenes/' . $nombreImagen; //url para la BD
        }
        $actualizaCorrectamente = $funcionario->fill($nuevosDatos)->save();
        if ($actualizaCorrectamente) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    private function eliminarFotoDelStorage($urlFotoFuncionario)
    {
        $url = str_replace('storage', 'public', $urlFotoFuncionario);
        Storage::delete($url);
    }

    public function edit($id)
    {
        $existeFuncionario = Funcionario::findOrFail($id);
        $existeFuncionario->fotoFuncionario = asset($existeFuncionario->fotoFuncionario); //agrego direccion url de la foto
        if ($existeFuncionario) {
            return response()->json(['success' => true, 'data' => $existeFuncionario]);
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
        $datos = Self::getLocalidades($request);
        return response()->json($datos);
    }
    private function getLocalidades($request)
    {
        $datos = Localidad::select('localidad.*', 'sector.color')
            ->where('localidad.sector', '=', $request->sector)
            ->orderBy('localidad.unidad', 'asc')
            ->join('sector', 'sector.id', '=', 'localidad.sector')
            ->get();
        return $datos;
    }

    public function listar(Request $request)
    {
        if ($request->filtro != "0" && $request->buscar != "") {
            $datos = Self::getFuncionarios($request);
            return view('admin.funcionario.includes.tabla')->with('datos', $datos);
        }
    }
    private function getFuncionarios($request)
    {
        $datos = Funcionario::select('funcionario.*', 'estados.nombreEstado', 'sector.nombreSector', 'localidad.unidad')
            ->orderBy('created_at', 'desc')
            ->from('funcionario')
            ->join('estados', 'estados.id', '=', 'funcionario.estadoFuncionario')
            ->leftJoin('localidad', 'localidad.id', '=', 'funcionario.localidad')
            ->leftJoin('sector', 'sector.id', '=', 'localidad.sector')
            ->where([
                ["$request->filtro", 'LIKE', "$request->buscar%"]
            ])
            ->paginate(6);
        return $datos;
    }
}
