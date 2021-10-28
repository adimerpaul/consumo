<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;
    protected $fillable=[
        
        "actividad",
        "sector",
        "licencia",
        "razon",
        "descripcionactividad",
        "telefono",
        "numero",
        "direccion",
        "numpiso",
        "horario",
        "mts2",

        "zona",
        "barrio",
        "calle",
        "entrecalles",
        "numeroagua",
        "numeroelectrico",
        "observaciones",

       "fachada",
       "acera",
       "iluminacion",
       "letrero",

        "datoestablecimiento",

        "tipo",
        "gest",
        "ruc",

        "cargo",
        "estado",
        'contribuyente_id'
    ];
}
