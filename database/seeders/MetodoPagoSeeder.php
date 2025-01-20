<?php

namespace Database\Seeders;

use App\Models\Dashboard\MetodoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodosDePagos = [
            'Efectivo',
            'Yape',
            'Plin',
            'Tunki',
            'Transferencia Bancaria',
            'Depósito Bancario',
            'Tarjeta de Crédito',
            'Tarjeta de Débito',
            'Billetera Electrónica (como BIM)',
            'PayPal',
            'PagoEfectivo',
            'Cheque'
        ];
        foreach ($metodosDePagos as $key => $metodosDePago) {
            MetodoPago::create([
                'nombre' => $metodosDePago,
            ]);
        }
    }
}
