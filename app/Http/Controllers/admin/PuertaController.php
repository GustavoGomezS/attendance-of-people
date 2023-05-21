<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Puerta;
use Illuminate\Http\Request;

class PuertaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nombre' => ['required', 'string', 'max:9']]);
        $guardaCorrectamente = Self::puertaNueva($request);
        if ($guardaCorrectamente) {
            return response()->json(['success' => true]);
        }
    }
    private function puertaNueva($request)
    {
        $puerta = new Puerta();
        $puerta->nombrepuerta = $request->nombre;
        $puerta->save();
        if ($puerta->save()) {
            return true;
        }
    }

    public function destroy($puerta)
    {
        $borraCorrectamente = Puerta::destroy($puerta);
        if ($borraCorrectamente) {
            return response()->json(['success' => true]);
        }
    }

    public function listar()
    {
        $datos = Puerta::select()->orderBy('nombrePuerta', 'desc')->get();
        return view('admin.ubicacion.sectorPuerta.tablas.tablaPuerta')->with('datos', $datos);
    }
}
