<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    protected $connection = 'mysql';
    protected $table = "residente";
    protected $fillable = ['id', 'documentoResidente', 'nombreResidente', 'apellidoResidente', 'fotoResidente', 'localidad', 'telefonoResidente', 'estadoResidente', 'sexoResidente', 'fechaNacimientoResidente'];
}
