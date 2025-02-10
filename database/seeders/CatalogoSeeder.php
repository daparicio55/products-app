<?php

namespace Database\Seeders;

use App\Models\Dashboard\Catalogo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catalogo::create([
            'codigo' => '001',
            'nombre' => 'Laptop',
            'descripcion' => 'Laptop HP 15',
            'marca_id' => 1,
            'categoria_id' => 2,
            'medida_id' => 58,
            'precio' => 1500.00,
            'contiene' => 1
        ]);
        Catalogo::create([
            'codigo' => '002',
            'nombre' => 'Laptop',
            'descripcion' => 'Laptop HP 14',
            'marca_id' => 1,
            'categoria_id' => 2,
            'medida_id' => 58,
            'precio' => 1200.00,
            'contiene' => 1
        ]);
    }
}
