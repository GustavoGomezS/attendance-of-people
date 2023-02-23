<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "sector";
    protected $fillable = ['id', 'nombreSector', 'color'];
}
