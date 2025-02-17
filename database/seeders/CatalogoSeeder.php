<?php

namespace Database\Seeders;

use App\Models\Dashboard\Catalogo;
use App\Models\Dashboard\Categoria;
use App\Models\Dashboard\Marca;
use App\Models\Dashboard\Medida;
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
        $marca = Marca::where('nombre','=','Golden beach')->first();
        $categoria = Categoria::where('nombre','=','Cigarrillos')->first();
        $paquete = Medida::where('codigo','=','PK')->first();
        $caja = Medida::where('codigo','=','BX')->first();
        $unidad = Medida::where('codigo','=','NIU')->first();
        $producto_paquete = Catalogo::create([
            'codigo'=>'003',
            'nombre'=>'MENTOL Verde',
            'descripcion'=>'Carton de 12 unidades',
            'marca_id'=>$marca->id,
            'categoria_id'=>$categoria->id,
            'medida_id'=>$paquete->id,
            'precio'=>57.60,
            'contiene'=>12
        ]);
        $producto_caja = Catalogo::create([
            'codigo'=>'004',
            'nombre'=>'MENTOL Verde',
            'descripcion'=>'Cajetilla de 20 unidades',
            'marca_id'=>$marca->id,
            'categoria_id'=>$categoria->id,
            'medida_id'=>$caja->id,
            'precio'=>6,
            'contiene'=>20,
            'catalogo_id'=>$producto_paquete->id
        ]);
        Catalogo::create([
            'codigo'=>'005',
            'nombre'=>'MENTOL Verde',
            'descripcion'=>'x Unidad',
            'marca_id'=>$marca->id,
            'categoria_id'=>$categoria->id,
            'medida_id'=>$unidad->id,
            'precio'=>0.5,
            'contiene'=>1,
            'catalogo_id'=>$producto_caja->id
        ]);
    }
}
