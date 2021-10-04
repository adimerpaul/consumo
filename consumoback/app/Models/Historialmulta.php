<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historialmulta extends Model
{
    use HasFactory;
    protected $fillable=[
        'detallemulta_id',
        'multa_id',
        'monto',
        'fecha',
        'inicio',
        'fin',
        'estado',
        'observacion',
        'licencia_id',
    ];

    public function detallemulta(){
        return $this->belongsTo(DetalleMulta::class)->with('multa');
    }

}
