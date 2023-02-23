<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minuta extends Model
{
  protected $connection = 'mysql';
  protected $table = "minuta";
  protected $fillable = ['id', 'usuario', 'comentario'];
}
