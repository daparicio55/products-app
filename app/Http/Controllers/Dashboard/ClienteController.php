<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Cliente;
use App\Traits\ClienteTrait;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Dashboard\TipoDocumento;

class ClienteController extends Controller
{
    use ClienteTrait;

    public function index(){
        $clientes = Cliente::orderBy('id','desc')->get();
        return view('dashboard.clientes.index', compact('clientes'));
    }

    public function create(){
        return view('dashboard.clientes.create');
    }

    public function store(StoreClienteRequest $request){
        $request['tipo_documento_id'] = $request->tipo_documento;       
        Cliente::create($request->all());
        return redirect()->route('dashboard.clientes.index');
    }
    
    public function edit($id){
        $cliente = Cliente::find($id);
        return view('dashboard.clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, $id){
        $request['tipo_documento_id'] = $request->tipo_documento;
        $cliente = Cliente::find($id);
        $cliente->update($request->all());
        return redirect()->route('dashboard.clientes.index');
    }

    public function destroy($id){
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('dashboard.clientes.index');
    }
}
