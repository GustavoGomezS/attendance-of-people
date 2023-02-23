<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puerta extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "puerta";
    protected $fillable = ['id', 'nombrePuerta'];
}
