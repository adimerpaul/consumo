<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;
    protected $fillable=[

        "actividad_id",
        "sector_id",
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
        "observacion",

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
    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }
    public function sector(){
        return $this->belongsTo(Sector::class);
    }
}
