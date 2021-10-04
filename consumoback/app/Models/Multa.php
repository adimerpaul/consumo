<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    use HasFactory;
    protected $fillable=[
        'titulo',
    ];
    public function detallemultas(){
        return $this->hasMany(Detallemulta::class);
    }

}
