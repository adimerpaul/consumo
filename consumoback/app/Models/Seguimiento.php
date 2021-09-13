<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'observacion',
        'fecha',
        'hora',
        "tramite_id",
        "user_id",
    ];
}
