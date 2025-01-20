<?php

namespace Database\Seeders;

use App\Models\Dashboard\TipoComprobante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoComprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comprobantes = [
            'Recibo',
            'Factura',
            'Boleta',
            'Nota de Crédito',
            'Nota de Débito',
        ];
        foreach ($comprobantes as $key => $comprobante) {
            # code...
            TipoComprobante::create([
                'nombre' => $comprobante,
            ]);
        }
    }
}
