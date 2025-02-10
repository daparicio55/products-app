<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ConfiguracionController extends Controller
{
    public function index()
    {
        return view('configuracion.index');
    }
    public function store(Request $request){
        $request->validate([
            'company_email' => 'required|email',
            'company_password' => 'confirmed',
            'company_ruc' => 'required|min:11|max:11',
            'company_razon_social' => 'required',
            'company_nombre_comercial' => 'required',
            'company_departamento'=> 'required',
            'company_provincia'=> 'required',
            'company_distrito'=> 'required',
            'company_urbanizacion'=> 'required',
            'company_direccion'=> 'required',
            'company_ubigeo'=> 'required'
        ]);
        
        $user = User::findOrFail(Auth::user()->id);
        $user->company_email = $request->company_email;
        if($request->company_password){
            $user->company_password = $request->company_password;
        }
        $user->company_ruc = $request->company_ruc;
        $user->company_razon_social = $request->company_razon_social;
        $user->company_nombre_comercial = $request->company_nombre_comercial;
        $user->company_ubigeo = $request->company_ubigeo;
        $user->company_direccion = $request->company_direccion;
        $user->company_departamento = $request->company_departamento;
        $user->company_provincia = $request->company_provincia;
        $user->company_distrito = $request->company_distrito;
        $user->company_urbanizacion = $request->company_urbanizacion;
        $user->update();

        return Redirect::route('dashboard')->with('info','Datos de la empresa actualizados correctamente');        
    }
}
