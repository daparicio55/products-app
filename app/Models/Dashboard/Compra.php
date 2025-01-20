<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public function catalogos(){
        return $this->belongsToMany(Catalogo::class)
        ->withPivot('cantidad', 'precio')
        ->withTimestamps();
    }
    public function proveedore(){
        return $this->belongsTo(Proveedore::class);
    }
}
