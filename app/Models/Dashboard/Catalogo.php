<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    //
    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'contiene',
        'categoria_id',
        'medida_id',
        'precio',
        'marca_id'
    ];

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function medida(){
        return $this->belongsTo(Medida::class);
    }

    public function superior(){
        return $this->belongsTo(Catalogo::class,'catalogo_id','id');
    }

    public function inferior(){
        return $this->hasOne(Catalogo::class,'catalogo_id','id');
    }

    public function compras(){
        return $this->belongsToMany(Compra::class);
    }
    public function ventas(){
        return $this->belongsToMany(Venta::class)
        ->withPivot('cantidad','precio')
        ->withTimestamps();
    }
}
