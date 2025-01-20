<?php

namespace Database\Seeders;

use App\Models\Dashboard\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'nombre'=>'Juan',
            'apellido_paterno'=>'Perez',
            'apellido_materno'=>'Gomez',
            'numero_documento'=>'41234561',
            'tipo_documento_id'=>1,
            'email'=>'juan@gmail.com',
            'telefono'=>'9234567890',
            'direccion'=>'Calle 123',
        ]);
        
        Cliente::create([
            'nombre'=>'Maria Juana',
            'apellido_paterno'=>'Torres',
            'apellido_materno'=>'Lara',
            'numero_documento'=>'41234562',
            'tipo_documento_id'=>1,
            'email'=>'maria@gmail.com',
            'telefono'=>'9234567890',
            'direccion'=>'Calle 123',
        ]);
    }
}
