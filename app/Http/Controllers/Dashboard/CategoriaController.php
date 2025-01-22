<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function index(){
        $categorias = Categoria::all();
        return view('dashboard.categorias.index',compact('categorias'));
    }
    public function create(){
        return view('dashboard.categorias.create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre'=>'required|unique:categorias,nombre'
        ]);
        Categoria::create($request->all());
        return redirect()->route('dashboard.categorias.index');
    }
    public function edit(Categoria $categoria){
        return view('dashboard.categorias.edit',compact('categoria'));
    }
    public function update(Request $request, Categoria $categoria){
        $request->validate([
            'nombre'=>'required|unique:categorias,nombre,'.$categoria->id
        ]);
        $categoria->update($request->all());
        return redirect()->route('dashboard.categorias.index');
    }
    public function destroy(Categoria $categoria){
        $categoria->delete();
        return redirect()->route('dashboard.categorias.index');
    }
}
