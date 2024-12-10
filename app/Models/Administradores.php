<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administradores extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'DUI',
        'género',
        'fecha_de_nacimiento',
        'lugar_de_nacimiento',
        'gmail',
        'contraseña',
    ];

}
