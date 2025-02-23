<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        //Encargado de la creacion de nuevos negocios
        $system_administrador = Role::create([
            'name'=>'SystemAdministrador',
        ]);
        //Administrador del negocio o a quien le voy ar el sistema
        $administrator = Role::create([
            'name'=>'Administrador',
        ]);
        //PERMISOS PARA EL ADMINISTRADOR DEL SISTEMA YOOO
        $array_administrador_permisions = ([
            'administrador.dashboard.index',
            //rutas para empresas
            'administrador.empresas.index',
            'administrador.empresas.create',
            'administrador.empresas.store',
            'administrador.empresas.edit',
            'administrador.empresas.update',
            'administrador.empresas.show',
            'administrador.empresas.destroy',
            //rutas para locales
            'administrador.locales.index',
            'administrador.locales.create',
            'administrador.locales.store',
            'administrador.locales.edit',
            'administrador.locales.update',
            'administrador.locales.show',
            'administrador.locales.destroy',
            //rutas para los usuarios
            'administrador.users.index',
            'administrador.users.create',
            'administrador.users.store',
            'administrador.users.edit',
            'administrador.users.update',
            'administrador.users.show',
            'administrador.users.destroy',
            //rutas para marcas
            'dashboard.marcas.index',
            'dashboard.marcas.create',
            'dashboard.marcas.store',
            'dashboard.marcas.edit',
            'dashboard.marcas.update',
            'dashboard.marcas.show',
            'dashboard.marcas.destroy',
            //rutas para medidas,
            'dashboard.medidas.index',
            'dashboard.medidas.create',
            'dashboard.medidas.store',
            'dashboard.medidas.edit',
            'dashboard.medidas.update',
            'dashboard.medidas.show',
            'dashboard.medidas.destroy',
            //rutas para categorias
            'dashboard.categorias.index',
            'dashboard.categorias.create',
            'dashboard.categorias.store',
            'dashboard.categorias.edit',
            'dashboard.categorias.update',
            'dashboard.categorias.show',
            'dashboard.categorias.destroy',
            //rutas para proveedores
            'dashboard.proveedores.index',
            'dashboard.proveedores.create',
            'dashboard.proveedores.store',
            'dashboard.proveedores.edit',
            'dashboard.proveedores.update',
            'dashboard.proveedores.show',
            'dashboard.proveedores.destroy',
            //rutas para metodos de pagos
            'dashboard.metodospagos.index',
            'dashboard.metodospagos.create',
            'dashboard.metodospagos.store',
            'dashboard.metodospagos.edit',
            'dashboard.metodospagos.update',
            'dashboard.metodospagos.show',
            'dashboard.metodospagos.destroy',
            //rutas para tipos de comprobantes
            'dashboard.tiposcomprobantes.index',
            'dashboard.tiposcomprobantes.create',
            'dashboard.tiposcomprobantes.store',
            'dashboard.tiposcomprobantes.edit',
            'dashboard.tiposcomprobantes.update',
            'dashboard.tiposcomprobantes.show',
            'dashboard.tiposcomprobantes.destroy',
            //rutas para los clientes
            'dashboard.clientes.index',
            'dashboard.clientes.create',
            'dashboard.clientes.store',
            'dashboard.clientes.edit',
            'dashboard.clientes.update',
            'dashboard.clientes.show',
            'dashboard.clientes.destroy',
            'dashboard.clientes.buscar',

        ]);
        foreach ($array_administrador_permisions as $key => $array_administrador_permision) {
            # code...
            Permission::create([
                'name'=>$array_administrador_permision
            ])->assignRole($system_administrador);
        }
        //PERMISOS PARA LOS DUEÑOS DE LOCALES
        $array_propietario_permisions = ([
            'dashboard',
            //rutas para marcas
            'dashboard.marcas.index',
            'dashboard.marcas.create',
            'dashboard.marcas.store',
            // 'dashboard.marcas.edit',
            // 'dashboard.marcas.update',
            'dashboard.marcas.show',
            'dashboard.marcas.destroy',
            //rutas para medidas,
            'dashboard.medidas.index',
            'dashboard.medidas.create',
            'dashboard.medidas.store',
            // 'dashboard.medidas.edit',
            // 'dashboard.medidas.update',
            'dashboard.medidas.show',
            //'dashboard.medidas.destroy',
            //rutas para categorias
            'dashboard.categorias.index',
            'dashboard.categorias.create',
            'dashboard.categorias.store',
            //'dashboard.categorias.edit',
            //'dashboard.categorias.update',
            'dashboard.categorias.show',
            //'dashboard.categorias.destroy',
            //rutas para catalogos
            'dashboard.catalogos.index',
            'dashboard.catalogos.create',
            'dashboard.catalogos.store',
            'dashboard.catalogos.edit',
            'dashboard.catalogos.update',
            'dashboard.catalogos.show',
            'dashboard.catalogos.destroy',
            //rutas para proveedores
            'dashboard.proveedores.index',
            'dashboard.proveedores.create',
            // 'dashboard.proveedores.store',
            // 'dashboard.proveedores.edit',
            // 'dashboard.proveedores.update',
            'dashboard.proveedores.show',
            // 'dashboard.proveedores.destroy',
            //rutas para compras
            'dashboard.compras.index',
            'dashboard.compras.create',
            'dashboard.compras.store',
            'dashboard.compras.show',
            'dashboard.compras.destroy',
            //rutas para los clientes
            'dashboard.clientes.index',
            'dashboard.clientes.create',
            'dashboard.clientes.store',
            'dashboard.clientes.edit',
            'dashboard.clientes.update',
            'dashboard.clientes.show',
            'dashboard.clientes.destroy',
            'dashboard.clientes.buscar',
            //rutas para las ventas
            'dashboard.ventas.index',
            'dashboard.ventas.create',
            'dashboard.ventas.store',
            'dashboard.ventas.show',
            'dashboard.ventas.destroy',
            //rutas para reportes de compras
            'dashboard.reportes.compras.index',
            'dashboard.reportes.compras.show',
            //rutas para reportes de ventas
            'dashboard.reportes.ventas.index',
            'dashboard.reportes.ventas.show',
        ]);
        foreach ($array_propietario_permisions as $key => $array_propietario_permision) {
            # code...
            Permission::firstOrCreate([
                'name'=>$array_propietario_permision
            ])->assignRole($administrator);
        }
        
    }
}
