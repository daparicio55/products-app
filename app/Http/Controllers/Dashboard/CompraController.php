<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompraRequest;
use App\Models\Dashboard\Catalogo;
use App\Models\Dashboard\Compra;
use App\Models\Dashboard\Proveedore;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    //
    public function index()
    {
        $compras = Compra::orderBy('id','desc')->paginate(15);
        return view('dashboard.compras.index',compact('compras'));
    }
    public function create()
    {
        $catalogos = Catalogo::orderBy('nombre','asc')
        ->get();
        $proveedores = Proveedore::all();
        return view('dashboard.compras.create', compact('catalogos', 'proveedores'));
    }
    /* public function store(StoreCompraRequest $request) */
    public function store(Request $request)
    {
        return $request;
        try {
            //guardamos la compra
            $compra = new Compra();
            $compra->fecha = $request->fecha;
            $compra->numero = $request->numero;
            $compra->igv_status = isset($request->igv_status) ? 1 : 0;
            $compra->proveedore_id = $request->proveedore_id;
            $compra->save();

            //agregamos los detalles de la compra
            $compra->catalogos()->attach($this->getColletion($request));

            //actualizamos los totales 
            $this->setTotales($request,$compra);
            
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }       
        return redirect()->route('dashboard.compras.index');
    }

    public function show(Compra $compra)
    {
        return view('dashboard.compras.show',compact('compra'));
    }

    public function destroy($id)
    {
        $compra = Compra::find($id);
        $compra->delete();
        return redirect()->route('dashboard.compras.index');
    }

    public function setTotales($request,$compra){
        $totales = $this->getTotales($request);
        $compra->subtotal = $totales['subtotal'];
        $compra->total = $totales['total'];
        $compra->igv = $totales['igv'];
        $compra->update();
    }

    public function getTotales($request){
        $total = 0;
        $igv = 0;
        $subtotal = 0;
        for ($i=0; $i < count($request->catalogos); $i++) { 
            $subtotal += $request->cantidades[$i] * $request->precios[$i];
        }
        if(isset($request->igv_status)){
            $igv = $subtotal * 0.18;
        }
        $total = $subtotal + $igv;
        return [
            'subtotal'=>$subtotal, 
            'igv'=>$igv, 
            'total'=>$total
        ]; 
    }
    public function getColletion($request){
        $data = collect($request->catalogos)->mapWithKeys(function ($catalogo, $index) use ($request) {
            return [
                $catalogo => [
                    'cantidad' => $request->cantidades[$index],
                    'precio' => $request->precios[$index],
                ],
            ];
        });
        return $data;
    }
}
