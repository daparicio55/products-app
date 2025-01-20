<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    //
    public function index(){
        $medidas = Medida::all();
        return view('dashboard.medidas.index',compact('medidas'));
    }
    public function create(){
        return view('dashboard.medidas.create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre'=>'required|unique:medidas,nombre',
        ]);
        Medida::create($request->all());
        return redirect()->route('medidas.index');
    }
    public function edit(Medida $medida){
        $medida = Medida::find($medida->id);
        return view('dashboard.medidas.edit',compact('medida'));
    }
    public function update(Request $request, Medida $medida){
        $request->validate([
            'nombre'=>'required|unique:medidas,nombre,'.$medida->id,
        ]);
        $medida = Medida::find($medida->id);
        $medida->update($request->all());
        return redirect()->route('medidas.index');
    }
    public function destroy(Medida $medida){
        $medida = Medida::find($medida->id);
        $medida->delete();
        return redirect()->route('medidas.index');
    }
}
