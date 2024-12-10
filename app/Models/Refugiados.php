<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refugiados extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'fechaNacimiento',
        'telefono',
        'genero',
        'dui',
        'fechaIngreso',
        'nunPersonasFamiliar',
        'condicionSalud',
        'albergueAsignado',
        'observaciones',
    ];

}
