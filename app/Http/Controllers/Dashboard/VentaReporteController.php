<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Catalogo;
use App\Models\Dashboard\Venta;
use Illuminate\Http\Request;

class VentaReporteController extends Controller
{
    //
    protected $fecha_fin;
    protected $fecha_inicio;

    public function catalogo_redondear($array_catalogos)
    {
        $divisor = 0;
        for ($i = count($array_catalogos) - 1; $i >= 0; $i--) {
            # code...            
            if ($array_catalogos[$i]['cantidad_ventas'] == 0) {
                $array_catalogos[$i]['cantidad_redondeado'] = 0;
            } else {
                if ($array_catalogos[$i]['inferior'] == null) {
                    if ($array_catalogos[$i]['superior'] == null) {
                        $array_catalogos[$i]['cantidad_redondeado'] = $array_catalogos[$i]['cantidad_ventas'];
                    } else {
                        //ahora si vamos a redondear.
                        $array_catalogos[$i]['cantidad_redondeado'] = $array_catalogos[$i]['cantidad_ventas'] % $array_catalogos[$i]['superior']['contiene'];
                        //ahora el divisor se acumulara;
                        $divisor = intdiv($array_catalogos[$i]['cantidad_ventas'], $array_catalogos[$i]['superior']['contiene']);
                    }
                } else {
                    if ($array_catalogos[$i]['superior'] != null) {
                        $sumar = $array_catalogos[$i]['cantidad_ventas'] + $divisor;
                        if ($sumar == 0) {
                            $array_catalogos[$i]['cantidad_redondeado'] = 0;
                        } else {
                            $array_catalogos[$i]['cantidad_redondeado'] = $sumar % $array_catalogos[$i]['superior']['contiene'];
                            $divisor = intdiv($sumar, $array_catalogos[$i]['superior']['contiene']);
                        }
                    } else {
                        $array_catalogos[$i]['cantidad_redondeado'] = $array_catalogos[$i]['cantidad_ventas'] + $divisor;
                    }
                }
            }
        }
        return $array_catalogos;
    }

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
                'superior' => $this->buildArraySuperior($catalogo->superior),
                'inferior' => $this->buildArrayInferior($catalogo->inferior)
            ];
            //ahora lo redondeamos 
            return $array_catalogo;
        }
        return null;
    }

    public function buildArraySuperior($catalogo)
    {
        if ($catalogo != null) {
            $array_catalogos = [
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
                'cantidad_ventas' => $this->getVentas($catalogo->id)
            ];
            return $array_catalogos;
        }
        return null;
    }

    public function buildArrayInferior($catalogo)
    {
        if ($catalogo != null) {
            $array_catalogos = [
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
                'cantidad_ventas' => $this->getVentas($catalogo->id)
            ];
            return $array_catalogos;
        }
        return null;
    }

    public function getVentas($catalogo_id)
    {
        if ($this->fecha_fin != null && $this->fecha_inicio != null) {
            $ventas = Catalogo::with(['ventas' => function ($query) {
                $query->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin]);
            }])->find($catalogo_id);
        } else {
            $ventas = Catalogo::with(['ventas'])->find($catalogo_id);
        }
        $cantidad_ventas = $ventas->ventas->sum('pivot.cantidad');
        return $cantidad_ventas;
    }

    public function index()
    {
        $catalogos = Catalogo::orderBy('nombre', 'asc')->get();
        return view('dashboard.reportes.ventas.index', compact('catalogos'));
    }
    public function show(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required|after_or_equal:fecha_inicio'
        ]);
        $this->fecha_inicio = $request->fecha_inicio;
        $this->fecha_fin = $request->fecha_fin;
        $datos = $this->getAllVentas($request);
        return view('dashboard.reportes.ventas.show', compact('datos'));
    }
    public function getAllVentas($request){
        //vamos a buscar la ventas
        $array = [];
        $catalogos_vendidos = Catalogo::with([
            'ventas' => function ($query) use ($request) {
                $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
            }
        ])->where('catalogo_id', '=', null)->get();
        foreach ($catalogos_vendidos as $key => $catalogos_vendido) {
            $array_catalogos = [];
            $catalogo = Catalogo::findOrFail($catalogos_vendido->id);

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
