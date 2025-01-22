<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class CatalogoCompra extends Model
{
    protected $table = 'catalogo_compra';

    public function catalogo(){
        return $this->belongsTo(Catalogo::class);
    }

    public function compra(){
        return $this->belongsTo(Compra::class);
    }
}
