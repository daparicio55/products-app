<?php

namespace Database\Seeders;

use App\Models\Dashboard\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Maquinaria Agrícola',
            'Herramientas Manuales',
            'Sistemas de Riego',
            'Fertilizantes y Abonos',
            'Semillas y Cultivos',
            'Equipos de Protección Personal',
            'Herramientas Motorizadas',
            'Insumos para Ganadería',
            'Productos de Fumigación',
            'Materiales de Empaque',
            'Equipos de Almacenamiento',
            'Repuestos y Accesorios',
            'Construcción de Invernaderos',
            'Alimentos para Animales',
            'Sistemas de Energía Renovable',
            'Plásticos Agrícolas',
            'Productos de Mantenimiento de Maquinaria',
            'Herramientas de Medición y Control',
            'Productos de Jardinería',
            'Mallas y Cercas',
            'Materiales de Construcción Rural',
            'Compostadores y Sistemas de Reciclaje',
            'Productos para Control de Plagas',
            'Iluminación Agrícola',
            'Sistemas Hidropónicos',
            'Bebederos y Comederos',
            'Sustratos para Cultivos',
            'Estacas y Tutores',
            'Envases y Contenedores',
            'Accesorios para Riego',
            'Motores y Bombas',
            'Equipos de Siembra',
            'Paneles Solares y Generadores',
            'Cigarrillos'
        ];
        foreach ($categorias as $key => $categoria) {
            # code...
            Categoria::create([
                'nombre' => $categoria,
            ]);
        }
    }
}
