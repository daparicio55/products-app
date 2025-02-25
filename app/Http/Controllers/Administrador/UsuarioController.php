<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Administrador\Locale;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    function index(){
        $users = User::whereHas('roles',function($query){
            $query->where('name','Administrador');
        })->get();
        return view('administrador.usuarios.index',compact('users'));
    }

    function create(){
        $locales = Locale::all();
        return view('administrador.usuarios.create',compact('locales'));
    }

    function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'locale_id'=>'required',
        ]);
        $user = User::create($request->all());
        $user->locale_id = $request->locale_id;
        $user->update();
        $user->assignRole('Administrador');
        return redirect()->route('administrador.users.index');
    }

    function edit($id){
        $user = User::find($id);
        $locales = Locale::all();
        return view('administrador.usuarios.edit',compact('user','locales'));
    }

    function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'confirmed',
            'locale_id'=>'required',
        ]);
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('administrador.users.index');
    }

    function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('administrador.users.index');
    }

}
