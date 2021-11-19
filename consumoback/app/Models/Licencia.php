<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;
    protected $fillable=[
        'num',
        'numlicencia',
        "fecha",
        "fechaautorizacion",
        "fechafin",
        "foto",
        "hora",
        "fechalimite",
        "tipo",
        "estado",
        "entramite",
        "user_id",
        "negocio_id",
        "contribuyente_id",
        "caso_id",
        "tramite_id",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function negocio(){
        return $this->belongsTo(Negocio::class)->with('contribuyente');
    }
    public function contribuyente(){
        return $this->belongsTo(contribuyente::class);
    }
    public function caso(){
        return $this->belongsTo(Caso::class);
    }
    public function tramite(){
        return $this->belongsTo(Tramite::class)->with('seguimientos');
    }

    public function historialmultas(){
        return $this->hasMany(Historialmulta::class)->with('detallemulta');
    }
}
