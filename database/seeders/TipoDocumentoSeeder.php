<?php

namespace Database\Seeders;

use App\Models\Dashboard\TipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos_documentos = [
            ["codigo" => "1", "nombre" => "DOCUMENTO NACIONAL DE IDENTIDAD (DNI)"],
            ["codigo" => "6", "nombre" => "REGISTRO ÚNICO DE CONTRIBUYENTES (RUC)"],
            ["codigo" => "4", "nombre" => "CARNET DE EXTRANJERIA"],
            ["codigo" => "7", "nombre" => "PASAPORTE"],
            ["codigo" => "A", "nombre" => "CÉDULA DIPLOMÁTICA DE IDENTIDAD"],
            ["codigo" => "0", "nombre" => "OTROS TIPOS DE DOCUMENTOS"],
        ];
        foreach ($tipos_documentos as $key => $tipo_documento) {
            TipoDocumento::create([
                'nombre' => $tipo_documento['nombre'],
                'codigo' => $tipo_documento['codigo'],
            ]);
        }
    }
}
