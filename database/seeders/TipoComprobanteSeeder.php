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
            [
                'nombre' => 'Factura',
                'codigo' => '01',
            ],
            [
                'nombre' => 'Boleta',
                'codigo' => '03',
            ],
            [
                'nombre' => 'Nota de Crédito',
                'codigo' => '07',
            ],
            [
                'nombre' => 'Nota de Débito',
                'codigo' => '08',
            ],
            [
                'nombre' => 'Guía de Remisión',
                'codigo' => '09',
            ],
            [
                'nombre' => 'Ticket de Máquina Registradora',
                'codigo' => '12',
            ],
            [
                'nombre' => 'Comprobante de Retención',
                'codigo' => '20',
            ]
        ];
        foreach ($comprobantes as $key => $comprobante) {
            # code...
            TipoComprobante::create([
                'nombre' => $comprobante['nombre'],
                'codigo' => $comprobante['codigo']
            ]);
        }
    }
}
