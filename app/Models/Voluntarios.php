<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntarios extends Model
{
    
    protected $fillable = [
        'nombre',
        'telefono',
        'dui',
        'genero',
        'albergueAsignado',
        'area',
        'fechaNacimiento',
        'observaciones',
    ];

    
}
