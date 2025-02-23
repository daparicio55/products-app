<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('company_email')->nullable();
            $table->string('company_password')->nullable();
            $table->string('company_ruc')->nullable()->uniqu´;
            $table->string('company_razon_social')->nullable();
            $table->string('company_nombre_comercial')->nullable();
            $table->string('company_ubigeo')->nullable();
            $table->string('company_direccion')->nullable();
            $table->string('company_departamento')->nullable();
            $table->string('company_provincia')->nullable();
            $table->string('company_distrito')->nullable();
            $table->string('company_urbanizacion')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
