<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroFuncionario extends Model
{
    use HasFactory;
    protected $table = "registro_funcionario";
    protected $fillable = ['id', 'funcionario', 'nuevoEstado', 'created_at', 'updated_at'];

}
