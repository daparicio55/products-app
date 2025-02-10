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
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_email')->nullable();
            $table->string('company_password')->nullable();
            $table->string('company_ruc')->nullable();
            $table->string('company_razon_social')->nullable();
            $table->string('company_nombre_comercial')->nullable();
            $table->string('company_ubigeo')->nullable();
            $table->string('company_direccion')->nullable();
            $table->string('company_departamento')->nullable();
            $table->string('company_provincia')->nullable();
            $table->string('company_distrito')->nullable();
            $table->string('company_urbanizacion')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_email');
            $table->dropColumn('company_password');
            $table->dropColumn('company_ruc');
            $table->dropColumn('company_razon_social');
            $table->dropColumn('company_nombre_comercial');
            $table->dropColumn('company_ubigeo');
            $table->dropColumn('company_direccion');
            $table->dropColumn('company_departamento');
            $table->dropColumn('company_provincia');
            $table->dropColumn('company_distrito');
            $table->dropColumn('company_urbanizacion');
        });
    }
};
