<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;
    protected $fillable=[

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
    public function contribuyente(){
            return $this->belongsTo(Contribuyente::class);
    }
}
