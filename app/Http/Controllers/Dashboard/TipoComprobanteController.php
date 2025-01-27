<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\TipoComprobante;
use Illuminate\Http\Request;

class TipoComprobanteController extends Controller
{
    //
    public function index(){
        $tiposcomprobantes = TipoComprobante::all();
        return view('dashboard.tiposcomprobantes.index',compact('tiposcomprobantes'));
    }
    public function create(){
        return view('dashboard.tiposcomprobantes.create');
    }
    public function store(){
        request()->validate([
            'nombre' => 'required|string|max:255',
        ]);
        TipoComprobante::create(request()->all());
        return redirect()->route('dashboard.tiposcomprobantes.index'); 
    }
    public function edit($id){
        $tipocomprobante = TipoComprobante::find($id);
        return view('dashboard.tiposcomprobantes.edit', compact('tipocomprobante'));
    }
    public function update($id){
        request()->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $tipocomprobante = TipoComprobante::find($id);
        $tipocomprobante->update(request()->all());
        return redirect()->route('dashboard.tiposcomprobantes.index');
    }
    public function destroy($id){
        $tipocomprobante = TipoComprobante::find($id);
        $tipocomprobante->delete();
        return redirect()->route('dashboard.tiposcomprobantes.index');
    }
}
