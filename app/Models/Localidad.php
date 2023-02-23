<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "localidad";
    protected $fillable = ['id', 'sector', 'unidad'];
}
