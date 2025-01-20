<?php

use App\Http\Controllers\Dashboard\CatalogoController;
use App\Http\Controllers\Dashboard\CategoriaController;
use App\Http\Controllers\Dashboard\ClienteController;
use App\Http\Controllers\Dashboard\CompraController;
use App\Http\Controllers\Dashboard\CompraReporteController;
use App\Http\Controllers\Dashboard\MedidaController;
use App\Http\Controllers\Dashboard\MetodoPagoController;
use App\Http\Controllers\Dashboard\ProveedoreController;
use App\Http\Controllers\Dashboard\TipoComprobanteController;
use App\Http\Controllers\Dashboard\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');
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
    /* rutas para reportes */
    Route::get('/dashboard/reportes/compras',[CompraReporteController::class,'index'])
    ->name('dashboard.reportes.compras.index');
    Route::post('/dashboard/reportes/compras',[CompraReporteController::class,'get'])
    ->name('dashboard.reportes.compras.get');
});
