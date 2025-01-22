<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::get();
        return view('dashboard.marcas.index',compact('marcas'));
    }

    public function create()
    {
        return view('dashboard.marcas.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|unique:marcas,nombre',
        ]);
        Marca::create($request->all());
        return redirect()->route('dashboard.marcas.index');
    }

    public function edit(Marca $marca){
        return view('dashboard.marcas.edit',compact('marca'));
    }

    public function update(Request $request, Marca $marca){
        $request->validate([
            'nombre' => 'required|string|unique:marcas,nombre,'.$marca->id,
        ]);
        $marca->update($request->all());
        return redirect()->route('dashboard.marcas.index');
    }

    public function destroy(Marca $marca){
        $marca->delete();
        return redirect()->route('dashboard.marcas.index');
    }
}
