<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
  use HasFactory;
  protected $connection = 'mysql';
  protected $table = "funcionario";
  protected $fillable = ['id', 'documentoFuncionario', 'nombreFuncionario', 'apellidoFuncionario', 'fotoFuncionario', 'localidad', 'telefonoFuncionario', 'estadoFuncionario', 'poderAutorizar', 'sexoFuncionario', 'fechaNacimientoFuncionario','horaEntrada','horaSalida'];
}
