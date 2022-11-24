<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $connection = 'mysql';
    protected $table = "registro";
    protected $fillable = ['id', 'ingresoSalida', 'puerta', 'visitante', 'localidad', 'autorizaSeguridad', 'autorizaResidente', 'comentario',];
}
