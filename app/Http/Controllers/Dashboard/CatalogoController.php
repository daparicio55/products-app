<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Catalogo;
use App\Models\Dashboard\Categoria;
use App\Models\Dashboard\Medida;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    //
    public function index(){
        $catalogos = Catalogo::all();
        return view('dashboard.catalogos.index',compact('catalogos'));
    }
    public function create(){
        $categorias = Categoria::orderBy('nombre','asc')->get();
        $medidas = Medida::orderBy('nombre','asc')->get();
        $catalogs = Catalogo::orderby('nombre','asc')->get();
        return view('dashboard.catalogos.create',compact('categorias','medidas','catalogs'));
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:catalogos,codigo',
            'descripcion' => 'required',
            'contiene' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'medida_id' => 'required|exists:medidas,id',
            'precio' => 'required|numeric',
        ]);
        $catalogo = Catalogo::create($request->all());
        if(isset($request->catalogo_id)){
            $catalogo->catalogo_id = $request->catalogo_id;
            $catalogo->update();
        }
        return redirect()->route('catalogos.index');
    }
    public function edit(Catalogo $catalogo){
        $categorias = Categoria::all();
        $medidas = Medida::all();
        $catalogs = Catalogo::orderby('nombre','asc')->get();
        return view('dashboard.catalogos.edit',compact('catalogo','categorias','medidas','catalogs'));
    }
    public function update(Request $request, Catalogo $catalogo){
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:catalogos,codigo,'.$catalogo->id,
            'descripcion' => 'required',
            'contiene' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'medida_id' => 'required|exists:medidas,id',
            'precio' => 'required|numeric',
        ]);
        $catalogo->update($request->all());

        if(isset($request->catalogo_id)){
            $catalogo->catalogo_id = $request->catalogo_id;
            $catalogo->update();
        }

        if(isset($request->catalogo_id)){
            $catalogo->catalogo_id = $request->catalogo_id;
            $catalogo->update();
        }

        return redirect()->route('catalogos.index');
    }
    public function destroy(Catalogo $catalogo){
        $catalogo->delete();
        return redirect()->route('catalogos.index');
    }
    public function show($id){
        $catalogo = Catalogo::find($id);
        return view('dashboard.catalogos.show',compact('catalogo'));
    }
}
