<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    //
    public function index(){
        $metodospagos = MetodoPago::all();
        return view('dashboard.metodospagos.index',compact('metodospagos'));
    }
    public function create(){
        return view('dashboard.metodospagos.create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        MetodoPago::create($request->all());
        return redirect()->route('dashboard.metodospagos.index');
    }
    public function edit($id){
        $metodopago = MetodoPago::find($id);     
        return view('dashboard.metodospagos.edit', compact('metodopago'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $metodopago = MetodoPago::find($id);
        $metodopago->update($request->all());
        return redirect()->route('dashboard.metodospagos.index');
    }
    public function destroy($id){
        $metodopago = MetodoPago::find($id);
        $metodopago->delete();
        return redirect()->route('dashboard.metodospagos.index');
    }
}
