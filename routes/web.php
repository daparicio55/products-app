<?php

use App\Http\Controllers\Administrador\EmpresaController;
use App\Http\Controllers\Administrador\LocaleController;
use App\Http\Controllers\Administrador\UsuarioController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\Dashboard\CatalogoController;
use App\Http\Controllers\Dashboard\CategoriaController;
use App\Http\Controllers\Dashboard\ClienteController;
use App\Http\Controllers\Dashboard\CompraController;
use App\Http\Controllers\Dashboard\CompraReporteController;
use App\Http\Controllers\Dashboard\MarcaController;
use App\Http\Controllers\Dashboard\MedidaController;
use App\Http\Controllers\Dashboard\MetodoPagoController;
use App\Http\Controllers\Dashboard\ProveedoreController;
use App\Http\Controllers\Dashboard\TipoComprobanteController;
use App\Http\Controllers\Dashboard\VentaController;
use App\Http\Controllers\Dashboard\VentaReporteController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/administrador',function(){
    return Redirect::route('administrador.dashboard.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard')->can('dashboard');

    Route::get('/configuracion',[ConfiguracionController::class,'index'])
    ->name('configuracion.index');
    Route::post('/configuracion',[ConfiguracionController::class,'store'])
    ->name('configuracion.store');

    // rutas para las marcas
    Route::resource('/dashboard/marcas', MarcaController::class)->names('dashboard.marcas')
    ->except('show');
    /* rutas para las medidas */
    Route::resource('/dashboard/medidas', MedidaController::class)->names('dashboard.medidas')
    ->except('show');
    /* rutas para las categorias */
    Route::resource('/dashboard/categorias', CategoriaController::class)->names('dashboard.categorias')
    ->except('show');
    /* rutas para los catalogos */
    Route::resource('/dashboard/catalogos', CatalogoController::class)->names('dashboard.catalogos');

    /* rutas para los proveedores */
    Route::resource('/dashboard/proveedores', ProveedoreController::class)->names('dashboard.proveedores')
    ->except('show');
    
    /* rutas para las compras */
    Route::resource('/dashboard/compras', CompraController::class)->names('dashboard.compras')
    ->except('edit');
    
    /* rutas para los metodos de pagos */
    Route::resource('/dashboard/metodospagos', MetodoPagoController::class)->names('dashboard.metodospagos')
    ->except('show');

    /* rutas para tipos de comprobantes */
    Route::resource('/dashboard/tiposcomprobantes', TipoComprobanteController::class)->names('dashboard.tiposcomprobantes')
    ->except('show');

    /* rutas para los clientes */
    Route::resource('/dashboard/clientes',ClienteController::class)->names('dashboard.clientes')
    ->except('show');
    Route::get('/dashboard/clientes/{numero}/numero/{tipo}/tipo',[ClienteController::class,'buscarCliente'])
    ->name('dashboard.clientes.buscar');

    /* rutas para las ventas */
    Route::resource('/dashboard/ventas',VentaController::class)->names('dashboard.ventas')
    ->except(['edit','update']);

    /* rutas para reportes  de compras*/
    Route::get('/dashboard/reportes/compras',[CompraReporteController::class,'index'])
    ->name('dashboard.reportes.compras.index');
    Route::get('/dashboard/reportes/compras/show',[CompraReporteController::class,'show'])
    ->name('dashboard.reportes.compras.show');

    // rutas para reportes de compras
    Route::get('/dashboard/reportes/ventas',[VentaReporteController::class,'index'])
    ->name('dashboard.reportes.ventas.index');
    Route::get('/dashboard/reportes/ventas/show/',[VentaReporteController::class,'show'])
    ->name('dashboard.reportes.ventas.show');
})
->prefix('administrador')
->name('administrador.')
->group(function (){

    Route::get('/dashboard',function(){
        return view('administrador.dashboard.index');
    })
    ->name('dashboard.index')
    ->can('administrador.dashboard.index');

    //rutas para gestionar las empresas

    Route::get('/empresas',[EmpresaController::class,'index'])
    ->name('empresas.index')
    ->can('administrador.empresas.index');

    Route::get('/empresas/create',[EmpresaController::class,'create'])
    ->name('empresas.create')
    ->can('administrador.empresas.create');
    Route::post('/empresas',[EmpresaController::class,'store'])
    ->name('empresas.store')
    ->can('administrador.empresas.create');

    Route::get('/empresas/{empresa}/edit',[EmpresaController::class,'edit'])
    ->name('empresas.edit')
    ->can('administrador.empresas.edit');
    Route::put('/empresas/{empresa}',[EmpresaController::class,'update'])
    ->name('empresas.update')
    ->can('administrador.empresas.update');
    
    Route::delete('/empresas/{empresa}',[EmpresaController::class,'destroy'])
    ->name('empresas.destroy')
    ->can('administrador.empresas.destroy');

    //rutas para gestionar los locales

    Route::get('/locales',[LocaleController::class,'index'])
    ->name('locales.index')
    ->can('administrador.locales.index');

    Route::get('/locales/create',[LocaleController::class,'create'])
    ->name('locales.create')
    ->can('administrador.locales.create');
    Route::post('/locales',[LocaleController::class,'store'])
    ->name('locales.store')
    ->can('administrador.locales.store');

    Route::get('/locales/{locale}/edit',[LocaleController::class,'edit'])
    ->name('locales.edit')
    ->can('administrador.locales.edit');
    Route::put('/locales',[LocaleController::class,'update'])
    ->name('locales.update')
    ->can('administrador.locales.update');

    Route::delete('/locales/{locale}',[LocaleController::class,'destroy'])
    ->name('locales.destroy')
    ->can('administrador.locales.destroy');

    //rutas para gestionar los usuarios

    Route::get('/usuarios',[UsuarioController::class,'index'])
    ->name('usuarios.index')
    ->can('administrador.usuarios.index');


});
