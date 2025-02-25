<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocaleRequest;
use App\Http\Requests\UpdateLocaleRequest;
use App\Models\Administrador\Empresa;
use App\Models\Administrador\Locale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    //
    public function index(){
        $locales = Locale::get();
        return view('administrador.locales.index',compact('locales'));
    }

    public function create(){
        $empresas = Empresa::get();
        return view('administrador.locales.create',compact('empresas'));
    }

    public function store(StoreLocaleRequest $request){
        try {
            //code...
            Locale::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('administrador.locales.index')
            ->with('error','no se pudo guardar el local');
        }
        return Redirect::route('administrador.locales.index')
        ->with('succes','se guardo el local correctamente');
    }

    public function edit($id){
        try {
            //code...
            $locale = Locale::findOrFail($id);
            $empresas = Empresa::get();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('administrador.empresas.index')
            ->with('error','no se puede editar esta empresa');
        }
        return view('administrador.locales.edit',compact('locale','empresas'));
    }

    public function update(UpdateLocaleRequest $request,$id){
        try {
            //code...
            $local = Locale::findOrFail($id);
            $local->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('administrador.locales.index')
            ->with('error','no se puede actualizar el local');
        }
        return Redirect::route('administrador.locales.index')
        ->with('success','se actualizo el local correctamente');
    }

    public function destroy($id){
        try {
            $local = Locale::findOrFail($id);
            $local->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('administrador.locales.index')
            ->with('error','no se puede eliminar este local');
        }
        return Redirect::route('administrador.locales.index')
        ->with('success','se elemino el local correctamente');
    }

}
