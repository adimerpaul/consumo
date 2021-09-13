<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
    protected $fillable=[
        "nrotramite",
        "fecha",
        "fechalimite",
        "hora",
        "tipo",
        "padron",
        "estado",
        "estado2",
        "infraestructura",
        "seguridad",
        "medio",
        "salubridad",
        "nro",
        "tramitador",
        'user_id',
        'caso_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function licencia(){
        return $this->hasOne(Licencia::class)
            ->with('user')
            ->with('contribuyente')
            ->with('caso');
    }
    public function caso(){
        return $this->belongsTo(Caso::class);
    }
    public function contribuyente(){
        return $this->belongsTo(Contribuyente::class);
    }
    public function requisitos(){
        return $this->belongsToMany(Requisito::class);
    }
    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }
}
