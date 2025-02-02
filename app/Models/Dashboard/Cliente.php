<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'numero_documento',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'tipo_documento_id',
        'direccion',
        'telefono',
        'email'
    ];
    public function tipoDocumento(){
        return $this->belongsTo(TipoDocumento::class,'tipo_documento_id','id');
    }
}
