<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    //
    public $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'serie',
        'telefono',
        'empresa_id'
    ];
    
    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }
}
