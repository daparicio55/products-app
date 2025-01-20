<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $fillable = [
        'catalogo_id',
        'metodo_pago_id',
        'tipo_comprobante_id',
        'numero_comprobante',
        'fecha',
        'total',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function tipoComprobante()
    {
        return $this->belongsTo(TipoComprobante::class);
    }
    public function catalogos(){
        return $this->belongsToMany(Catalogo::class)
        ->withPivot('cantidad','precio')
        ->withTimestamps();
    }
}
