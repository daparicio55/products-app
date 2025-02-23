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
        $this->call(RoleSeeder::class);
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password'=> bcrypt('12345678'),
            // 'company_email' => 'jsnow@mail.com',
            // 'company_password' => '12345678',
            // 'company_ruc' => '20125478965',
            // 'company_razon_social' => 'Jhon Snow',
            // 'company_nombre_comercial' => 'Jhon Snow',
            // 'company_ubigeo' => '01001',
            // 'company_direccion' => 'Jr. Amazonas 120',
            // 'company_departamento' => 'AMAZONAS',
            // 'company_provincia' => 'CHACHAPOYAS',
            // 'company_distrito' => 'CHACHAPOYAS',
            // 'company_urbanizacion' => 'YANCE'
        ])->assignRole('SystemAdministrador');
        $this->call(MedidaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(MetodoPagoSeeder::class);
        $this->call(TipoComprobanteSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(ProveedoreSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(CatalogoSeeder::class);
    }
}
