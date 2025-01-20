<?php

namespace Database\Seeders;

use App\Models\Dashboard\Proveedore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Proveedore::create([
            'razon_social'=>'Proveedor de Productos S.A.C.',
            'ruc'=>'201234567890',
            'direccion'=>'Calle 123',
        ]);
        Proveedore::create([
            'razon_social'=>'Los Verdes de Servicios S.A.C.',
            'ruc'=>'201234567891',
            'direccion'=>'Calle sin destino 123',
        ]);
    }
}
