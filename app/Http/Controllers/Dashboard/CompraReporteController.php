<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CatalogoCompra;
use App\Models\Dashboard\Catalogo;
use Illuminate\Http\Request;

class CompraReporteController extends Controller
{
    //
    public function index()
    {
        $catalogos = Catalogo::whereCatalogoId(null)->get();
        return view('dashboard.reportes.compras.index',compact('catalogos'));
    }

    public function get(Request $request){
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'catalogo' => 'exists:catalogos,id',
        ]);

        $catalogosSuperiores = Catalogo::whereHas('compras',function($query) use ($request){
            $query->whereBetween('fecha',[$request->fecha_inicio,$request->fecha_fin]);
        })->where(function($query) use ($request){
            if($request->catalogo){
                $query->where('id',$request->catalogo);
            }
        })->whereCatalogoId(null)
        ->get();

        $array_catalogos = $this->getCompras($catalogosSuperiores);

        return view('dashboard.reportes.compras.show',compact('array_catalogos'));

    }

    public function getCompras($catalogosSuperiores){
        $array_catalogos = [];
        //$catalogosSuperiores = Catalogo::whereCatalogoId(null)->get();
        foreach ($catalogosSuperiores as $catalogoSuperior){

            $compras = CatalogoCompra::where('catalogo_id',$catalogoSuperior->id)->get();

            $catalogoInferior = $catalogoSuperior->inferior;

            $array_inferior = [];

            while (isset($catalogoInferior->id)) {
                # code...
                $comprass = CatalogoCompra::where('catalogo_id',$catalogoInferior->id)->get();
                $array_inferior [] = [
                    'catalogo_id' => $catalogoInferior->id,
                    'codigo' => $catalogoInferior->codigo,
                    'nombre' => $catalogoInferior->nombre,
                    'descripcion' => $catalogoInferior->descripcion,
                    'medida' => $catalogoInferior->medida->nombre,
                    'contiene' => $catalogoInferior->contiene,
                    'total_compras' => $comprass->count(),
                    'total' => $comprass->sum('cantidad'),
                ];
                //ahora actualiza el catalogo inferior
                $catalogoInferior = $catalogoInferior->inferior;

            }

            $array_catalogos [] = [
                /* 'catalogo' => $catalogoSuperior, */
                'catalogo_id' => $catalogoSuperior->id,
                'codigo' => $catalogoSuperior->codigo,
                'nombre' => $catalogoSuperior->nombre,
                'descripcion' => $catalogoSuperior->descripcion,
                'medida' => $catalogoSuperior->medida->nombre,
                'contiene' => $catalogoSuperior->contiene,
                'total_compras' => $compras->count(),
                'total' => $compras->sum('cantidad'),
                'inferiores' => $array_inferior,
            ];
        }
        return $array_catalogos;
    }
}
