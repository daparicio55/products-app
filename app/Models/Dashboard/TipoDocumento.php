<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $fillable = [
        'nombre', 
        'codigo'
    ];
}
