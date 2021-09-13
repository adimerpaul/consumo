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
        "contribuyente_id",
        "caso_id",
        "tramite_id",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function contribuyente(){
        return $this->belongsTo(Contribuyente::class);
    }
    public function caso(){
        return $this->belongsTo(Caso::class);
    }
    public function tramite(){
        return $this->belongsTo(Tramite::class)->with('seguimientos');
    }
}
