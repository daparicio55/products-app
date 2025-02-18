<?php

namespace App\Traits;

use App\Models\Dashboard\Catalogo;

trait ReporteCompraVentaTrait
{
    public function buildArray($catalogo)
    {
        if ($catalogo != null) {
            $array_catalogo = [
                'id' => $catalogo->id,
                'nombre' => $catalogo->nombre,
                'codigo' => $catalogo->codigo,
                'descripcion' => $catalogo->descripcion,
                'contiene' => $catalogo->contiene,
                'categoria_id' => $catalogo->categoria_id,
                'categoria' => $catalogo->categoria->nombre,
                'medida_id' => $catalogo->medida_id,
                'medida' => $catalogo->medida->nombre,
                'precio' => $catalogo->precio,
                'marca_id' => $catalogo->marca_id,
                'marca' => $catalogo->marca->nombre,
                'cantidad_ventas' => $this->getVentas($catalogo->id),
                'cantidad_compras' => $this->getCompras($catalogo->id),
                'superior' => $this->buildArraySuperior($catalogo->superior),
                'inferior' => $this->buildArrayInferior($catalogo->inferior)
            ];
            //ahora lo redondeamos 
            return $array_catalogo;
        }
        return null;
    }

    public function getAll($request){
        //vamos a buscar la ventas
        $array = [];
        $catalogos_comprados = Catalogo::with([
            'compras' => function ($query) use ($request) {
                $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
            }
        ])->where('catalogo_id', '=', null)->get();

        $catalogos_vendidos = Catalogo::with([
            'ventas' => function ($query) use ($request) {
                $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
            }
        ])->where('catalogo_id', '=', null)->get();

        $catalogs = Catalogo::with(['compras'=> function($query) use ($request){
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        },'ventas' => function ($query) use ($request){
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        }])->where('catalogo_id', '=', null)->get();

        //return $catalogos_comprados;
        return $catalogs;

        foreach ($catalogos_comprados as $key => $catalogos_comprado) {
            $array_catalogos = [];
            $catalogo = Catalogo::findOrFail($catalogos_comprado->id);

            $array_catalogos[] = $this->buildArray($catalogo);

            while ($catalogo->inferior != null) {
                $array_catalogos[] = $this->buildArray($catalogo->inferior);
                $catalogo = $catalogo->inferior;
            }
            $array_catalogos = $this->catalogo_redondear($array_catalogos);
            $array [] =  $array_catalogos;
        }
        return $array;
    }
}
