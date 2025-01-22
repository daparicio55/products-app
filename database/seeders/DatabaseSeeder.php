<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password'=> bcrypt('12345678')
        ]);
        $this->call(MedidaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(MetodoPagoSeeder::class);
        $this->call(TipoComprobanteSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(ProveedoreSeeder::class);
        $this->call(MarcaSeeder::class);
    }
}
