<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Models\Administrador\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmpresaController extends Controller
{
    public function index(){
        $empresas = Empresa::get();
        return view('administrador.empresas.index',compact('empresas'));
    }
    
    public function create(){
        return view('administrador.empresas.create');
    }

    public function store(StoreEmpresaRequest $request){
        try {
            //code...
            Empresa::create($request->all());
            return Redirect::route('administrador.empresas.index')
            ->with('success','Empresa creada correctamente');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('administrador.empresas.index')
            ->with('error','Error al crear la empresa');
        }
    }

    public function edit($id){
        $empresa = Empresa::find($id);
        return view('administrador.empresas.edit',compact('empresa'));
    }

    public function update(UpdateEmpresaRequest $request, $id){

        try {
            //code...
            $data = $request->except('company_password');
            if($request->filled('company_password')){
                $data['company_password'] = $request->company_password;
            }
            $empresa = Empresa::findOrFail($id);
            $empresa->update($data);
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('administrador.empresas.index')
            ->with('error','Error al actualizar la empresa');
        }
        return Redirect::route('administrador.empresas.index')
        ->with('success','Empresa actualizada correctamente');
    }

    public function destroy($id){
        try {
            $empresa = Empresa::findOrFail($id);
            $empresa->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('administrador.empresas.index')
            ->with('error','Error al eliminar la empresa');
        }
        return Redirect::route('administrador.empresas.index')
        ->with('success','Se elimino la empresa correctamente');
    }
}
