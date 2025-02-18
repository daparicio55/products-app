<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\CatalogoCompra;
use App\Models\Dashboard\Catalogo;
use App\Traits\ReporteCompraVentaTrait;
use Illuminate\Http\Request;

class CompraReporteController extends Controller
{
    //
    protected $fecha_fin;
    protected $fecha_inicio;

    use ReporteCompraVentaTrait;

    public function index()
    {
        $catalogos = Catalogo::whereCatalogoId(null)->get();
        return view('dashboard.reportes.compras.index',compact('catalogos'));
    }

    public function show(Request $request){
        
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required|after_or_equal:fecha_inicio'
        ]);

        $this->fecha_inicio = $request->fecha_inicio;
        $this->fecha_fin = $request->fecha_fin;

        $datos = $this->getAll($request);
        return $datos;
    }
    
}
