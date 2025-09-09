<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    // Esto convierte automáticamente los campos de fecha a Carbon
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
}
