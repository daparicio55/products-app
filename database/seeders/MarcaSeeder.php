<?php

namespace Database\Seeders;

use App\Models\Dashboard\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            'John Deere',
            'Kubota',
            'Stihl',
            'Husqvarna',
            'New Holland',
            'Massey Ferguson',
            'Case IH',
            'Claas',
            'FMC',
            'Bayer',
            'Syngenta',
            'Corteva',
            'Dow AgroSciences',
            'Fertipar',
            'Yara',
            'Vikingo',
            'Gardena',
            'Rain Bird',
            'Toro',
            'Hunter',
            'Makita',
            'Bosch',
            'DeWalt',
            'Black+Decker',
            'Fiskars',
            'Bellota',
            'Truper',
            'Stanley',
            'Solo',
            '3M',
            'Scotts',
            'Agrometal',
            'AGCO',
            'CNH Industrial',
            'Netafim',
            'Valmont',
            'DripWorks',
            'Sakata',
            'Seminis',
            'Bejo',
            'Rijk Zwaan',
            'Takii',
            'Agrochem',
            'Monsanto',
            'Cheminova',
            'Arysta LifeScience',
            'Kverneland',
            'Krone',
            'Lemken',
            'BKT',
            'Trelleborg',
        ];
        foreach ($marcas as $key => $marca) {
            Marca::create([
                'nombre' => $marca,
            ]);
        }
    }
}
