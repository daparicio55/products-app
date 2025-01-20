<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVentaRequest;
use App\Models\Dashboard\Catalogo;
use App\Models\Dashboard\Cliente;
use App\Models\Dashboard\MetodoPago;
use App\Models\Dashboard\TipoComprobante;
use App\Models\Dashboard\Venta;
use App\Traits\ClienteTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    use ClienteTrait;

    public function index(){
        $ventas = Venta::orderBy('id','desc')
        ->paginate(15);
        return view('dashboard.ventas.index',compact('ventas'));
    }

    public function create(){
        $catalogos = Catalogo::all();
        $pagos = MetodoPago::all();
        $comprobantes = TipoComprobante::all();
        return view('dashboard.ventas.create',compact('catalogos','pagos','comprobantes'));
    }

    public function getLastNumber($request){
        $venta = Venta::where('tipo_comprobante_id',$request->tipo_comprobante)
        ->where('fecha',$request->fecha)
        ->orderBy('numero','desc')
        ->first();
        if($venta){
            return $venta->numero + 1;
        }else{
            return 1;
        }
    }

    public function store(StoreVentaRequest $request){
        //actualizamos al cliente si es necesario
        try {
            DB::beginTransaction();
            $cliente = $this->createOrUpdateCliente($request);
            $venta = new Venta();
            $venta->cliente_id = $cliente->id;
            $venta->metodo_pago_id = $request->metodo_pago;
            $venta->tipo_comprobante_id = $request->tipo_comprobante;
            $venta->fecha = $request->fecha;
            $venta->user_id = Auth::id();
            $venta->numero = $this->getLastNumber($request);
            $venta->save();

            //agregamos los detalles de la venta
            $venta->catalogos()->attach($this->getColletion($request));

            $this->setTotales($request,$venta);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
        return redirect()->route('ventas.index')->with('info','Venta registrada correctamente');
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

    public function setTotales($request,$venta){
        $totales = $this->getTotales($request);
        $venta->subtotal = $totales['subtotal'];
        $venta->total = $totales['total'];
        $venta->igv = $totales['igv'];
        $venta->update();
    }

    public function createOrUpdateCliente($request){
        if($request->cliente_id == 0){
            $cliente = Cliente::create($request->all());
        }else{
            $cliente = Cliente::find($request->cliente_id);
            $cliente->update($request->all());
        }
        return $cliente;
    }

    public function destroy($id){
        Venta::find($id)->delete();
        return redirect()->route('ventas.index');
    }
    
    public function show($id){
        $venta = Venta::find($id);
        return view('dashboard.ventas.show',compact('venta'));
    }
}
