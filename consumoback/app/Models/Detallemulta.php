<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallemulta extends Model
{
    use HasFactory;
    protected $fillable=[
        'multa_id',
        'monto',
        'dia',
    ];

    public function multa(){
        return $this->belongsTo(Multa::class);
    }
}
