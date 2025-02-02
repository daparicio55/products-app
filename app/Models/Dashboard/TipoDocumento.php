<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $fillable = [
        'nombre', 
        'codigo'
    ];
    public function clientes(){
        return $this->hasMany(Cliente::class,'tipo_documento_id','id');
    }
}
