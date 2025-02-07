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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class VentaController extends Controller
{
    use ClienteTrait;

    public function index(){
        $ventas = Venta::orderBy('id','desc')
        ->paginate(15);
        return view('dashboard.ventas.index',compact('ventas'));
    }

    public function create(){
        
        $pagos = MetodoPago::all();
        $comprobantes = TipoComprobante::all();
        $catalogos = $this->getCatalogosArray();
    
        return view('dashboard.ventas.create',compact('catalogos','pagos','comprobantes'));
    }

    public function getCatalogosArray(){
        $catalogos = Catalogo::get();
        $data = [];
        foreach ($catalogos as $catalogo) {
            $data[$catalogo->id] = [
                'nombre' => $catalogo->codigo.' '.$catalogo->nombre.' '.$catalogo->descripcion.' '. $catalogo->marca->nombre.' '. $catalogo->medida->nombre,
                'precio' => $catalogo->precio,
            ];
        }
        return $data;
    }


    public function getLastNumber($request){
        $venta = Venta::where('tipo_comprobante_id',$request->tipo_comprobante_id)        
        ->orderBy('numero','desc')
        ->first();
        if($venta){
            return $venta->numero + 1;
        }else{
            return 1;
        }
    }

    public function store(StoreVentaRequest $request){
        
        try {
            DB::beginTransaction();
            //creamo o actualizamos el cliente
            $cliente = $this->createOrUpdateCliente($request);
            //creamos la nueva venta
            $venta = new Venta();
            $venta->cliente_id = $cliente->id;
            $venta->metodo_pago_id = $request->metodo_pago_id;
            $venta->tipo_comprobante_id = $request->tipo_comprobante_id;
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
        return redirect()->route('dashboard.ventas.index')->with('info','Venta registrada correctamente');
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
        $request['tipo_documento_id'] = $request->tipo_documento;
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
        return redirect()->route('dashboard.ventas.index');
    }
    
    public function show($id){
        $venta = Venta::find($id);
        $response = Http::post('http://greenter.local/api/login',[
            'email' => 'jsnow@mail.com',
            'password' => '12345678'
        ]); 
        $token = $response->json()['access_token'];
        $data = [
            "ublVersion" => "2.1",
            "tipoOperacion" => "0101",
            "tipoDoc" => $venta->tipoComprobante->codigo,
            "serie" => $venta->tipoComprobante->letra.'001',
            "correlativo" => $venta->numero,
            "fechaEmision" => Carbon::parse($venta->created_at)->format('Y-m-d H:i:s'),
            "formaPago" => [
                "moneda" => "PEN",
                "tipo" => "Contado"
            ],
            "tipoMoneda" => "PEN",
            "company" => [
                "ruc" => "20125478965",
                "razonSocial" => "Software Produccion",
                "nombreComercial" => "Software Produccion",
                "address" => [
                    "ubigueo" => "150101",
                    "departamento" => "Amazonas",
                    "provincia" => "Chachapoyas",
                    "distrito" => "Chachapoyas",
                    "urbanizacion" => "-",
                    "direccion" => "Jr. Amazonas 120",
                    "codLocal" => "0000"
                ]
            ],
            "client" => [
                "tipoDoc" => $venta->cliente->tipoDocumento->codigo,
                "numDoc" => $venta->cliente->numero_documento,
                "rznSocial" => $venta->cliente->nombre,
            ],
            "details" => $this->getDetails($venta),
        ];    

        //return $data;

        $invoice_response = Http::withToken($token)->post('http://greenter.local/api/invoices/send',$data);     

        return $invoice_response->json();

        /* return view('dashboard.ventas.show',compact('venta')); */
    }

    public function getDetails($venta){
        $data = [];
        foreach ($venta->catalogos as $catalogo) {
            $data[] = [

                "tipAfeIgv" => "20",
                "codProducto" => $catalogo->codigo,
                "unidad" => $catalogo->medida->codigo,
                "cantidad" => $catalogo->pivot->cantidad,
                "mtoValorUnitario" => $catalogo->pivot->precio,
                "descripcion" => $catalogo->nombre .' '.$catalogo->descripcion,
                "mtoBaseIgv" => $catalogo->pivot->precio * $catalogo->pivot->cantidad,
                "porcentajeIgv" => $venta->igv == 0 ? "0" : "18",
                "igv" => $venta->ivg == 0 ? "0" : ($catalogo->pivot->precio * $catalogo->pivot->cantidad)*0.18,
                "totalImpuestos" => $venta->ivg == 0 ? "0" : ($catalogo->pivot->precio * $catalogo->pivot->cantidad)*0.18,
                "mtoValorVenta" => $catalogo->pivot->precio * $catalogo->pivot->cantidad,
                "mtoPrecioUnitario" => $venta->igv == 0 ? $catalogo->pivot->precio : $catalogo->pivot->precio + $venta->igv,

            ];
        }
        return $data;
    }
    
}
