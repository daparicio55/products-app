<?php

namespace Database\Seeders;

use App\Models\Dashboard\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidades = [
            ["codigo" => "4A", "nombre" => "BOBINAS"],
            ["codigo" => "BJ", "nombre" => "BALDE"],
            ["codigo" => "BLL", "nombre" => "BARRILES"],
            ["codigo" => "BG", "nombre" => "BOLSA"],
            ["codigo" => "BO", "nombre" => "BOTELLAS"],
            ["codigo" => "BX", "nombre" => "CAJA"],
            ["codigo" => "CT", "nombre" => "CARTONES"],
            ["codigo" => "CMK", "nombre" => "CENTIMETRO CUADRADO"],
            ["codigo" => "CMQ", "nombre" => "CENTIMETRO CUBICO"],
            ["codigo" => "CMT", "nombre" => "CENTIMETRO LINEAL"],
            ["codigo" => "CEN", "nombre" => "CIENTO DE UNIDADES"],
            ["codigo" => "CY", "nombre" => "CILINDRO"],
            ["codigo" => "CJ", "nombre" => "CONOS"],
            ["codigo" => "DZN", "nombre" => "DOCENA"],
            ["codigo" => "DZP", "nombre" => "DOCENA POR 10**6"],
            ["codigo" => "BE", "nombre" => "FARDO"],
            ["codigo" => "GLI", "nombre" => "GALON INGLES (4,545956L)"],
            ["codigo" => "GRM", "nombre" => "GRAMO"],
            ["codigo" => "GRO", "nombre" => "GRUESA"],
            ["codigo" => "HLT", "nombre" => "HECTOLITRO"],
            ["codigo" => "LEF", "nombre" => "HOJA"],
            ["codigo" => "SET", "nombre" => "JUEGO"],
            ["codigo" => "KGM", "nombre" => "KILOGRAMO"],
            ["codigo" => "KTM", "nombre" => "KILOMETRO"],
            ["codigo" => "KWH", "nombre" => "KILOVATIO HORA"],
            ["codigo" => "KT", "nombre" => "KIT"],
            ["codigo" => "CA", "nombre" => "LATAS"],
            ["codigo" => "LBR", "nombre" => "LIBRAS"],
            ["codigo" => "LTR", "nombre" => "LITRO"],
            ["codigo" => "MWH", "nombre" => "MEGAWATT HORA"],
            ["codigo" => "MTR", "nombre" => "METRO"],
            ["codigo" => "MTK", "nombre" => "METRO CUADRADO"],
            ["codigo" => "MTQ", "nombre" => "METRO CUBICO"],
            ["codigo" => "MGM", "nombre" => "MILIGRAMOS"],
            ["codigo" => "MLT", "nombre" => "MILILITRO"],
            ["codigo" => "MMT", "nombre" => "MILIMETRO"],
            ["codigo" => "MMK", "nombre" => "MILIMETRO CUADRADO"],
            ["codigo" => "MMQ", "nombre" => "MILIMETRO CUBICO"],
            ["codigo" => "MLL", "nombre" => "MILLARES"],
            ["codigo" => "UM", "nombre" => "MILLON DE UNIDADES"],
            ["codigo" => "ONZ", "nombre" => "ONZAS"],
            ["codigo" => "PF", "nombre" => "PALETAS"],
            ["codigo" => "PK", "nombre" => "PAQUETE"],
            ["codigo" => "PR", "nombre" => "PAR"],
            ["codigo" => "FOT", "nombre" => "PIES"],
            ["codigo" => "FTK", "nombre" => "PIES CUADRADOS"],
            ["codigo" => "FTQ", "nombre" => "PIES CUBICOS"],
            ["codigo" => "C62", "nombre" => "PIEZAS"],
            ["codigo" => "PG", "nombre" => "PLACAS"],
            ["codigo" => "ST", "nombre" => "PLIEGO"],
            ["codigo" => "INH", "nombre" => "PULGADAS"],
            ["codigo" => "RM", "nombre" => "RESMA"],
            ["codigo" => "DR", "nombre" => "TAMBOR"],
            ["codigo" => "STN", "nombre" => "TONELADA CORTA"],
            ["codigo" => "LTN", "nombre" => "TONELADA LARGA"],
            ["codigo" => "TNE", "nombre" => "TONELADAS"],
            ["codigo" => "TU", "nombre" => "TUBOS"],
            ["codigo" => "NIU", "nombre" => "UNIDAD (BIENES)"],
            ["codigo" => "ZZ", "nombre" => "UNIDAD (SERVICIOS)"],
            ["codigo" => "GLL", "nombre" => "US GALON (3,7843 L)"],
            ["codigo" => "YRD", "nombre" => "YARDA"],
            ["codigo" => "YDK", "nombre" => "YARDA CUADRADA"],
        ];

        foreach ($unidades as $unidade) {
            Medida::create([
                'nombre' => $unidade['nombre'],
                'codigo' => $unidade['codigo']
            ]);
        }
    }
}
