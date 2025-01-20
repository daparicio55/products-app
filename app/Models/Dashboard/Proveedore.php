<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    //
    protected $fillable = [
        'razon_social', 
        'ruc', 
        'direccion'
    ];
}
