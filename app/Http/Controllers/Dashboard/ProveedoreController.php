<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Proveedore;
use Illuminate\Http\Request;

class ProveedoreController extends Controller
{
    //
    public function index(){
        $proveedores = Proveedore::all();
        return view('dashboard.proveedores.index', compact('proveedores'));
    }
    public function create(){
        return view('dashboard.proveedores.create');
    }
    public function store(Request $request){
        $request->validate([
            'razon_social' => 'required',
            'ruc' => 'required|max:11|min:11|unique:proveedores,ruc',
            'direccion' => 'required'
        ]);
        Proveedore::create($request->all());
        return redirect()->route('proveedores.index');
    }
    public function edit(Proveedore $proveedore){
        return view('dashboard.proveedores.edit', compact('proveedore'));
    }
    public function update(Request $request, Proveedore $proveedore){
        $request->validate([
            'razon_social' => 'required',
            'ruc' => 'required|max:11|min:11|unique:proveedores,ruc,'.$proveedore->id,
            'direccion' => 'required'
        ]);
        $proveedore->update($request->all());
        return redirect()->route('proveedores.index');
    }
    public function destroy(Proveedore $proveedore){
        $proveedore->delete();
        return redirect()->route('proveedores.index');
    }
}
