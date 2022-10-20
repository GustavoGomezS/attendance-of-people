<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $connection = 'mysql';
    protected $table = "Visitante";
    protected $fillable = ['id', 'documentoVisitante', 'nombreVisitante', 'apellidoVisitante', 'fotoVisitante', 'telefonoVisitante', 'estadoVisitante', 'sexoVisitante', 'fechaNacimientoVisitante'];
}
