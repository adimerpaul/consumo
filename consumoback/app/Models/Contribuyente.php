<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombres",
        "paterno",
        "materno",
        "esposo",
        "cedula",
        "expedido",
        "telefono",
        "telofi",
        "domicilio",
        "calle",
        "numero",
        "casilla",
        "fax",
        "extrangero",
        "numeroextrangero",
        "numerodni",
        "zona",
        "nit",
    ];
}
