<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    public $fillable = [
        'company_email',
        'company_password',
        'company_ruc',
        'company_razon_social',
        'company_nombre_comercial',
        'company_departamento',
        'company_provincia',
        'company_distrito',
        'company_urbanizacion',
        'company_direccion',
        'company_ubigeo'
    ];

    public function locales(){
        return $this->hasMany(Locale::class);
    }
}
