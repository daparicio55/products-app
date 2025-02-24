<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
        'nombre'
    ];

    public function catalogos(){
        return $this->hasMany(Catalogo::class);
    }
}
