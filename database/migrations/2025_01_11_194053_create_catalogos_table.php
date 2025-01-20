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
        Schema::create('catalogos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->string('descripcion');
            $table->decimal('contiene', 10, 2);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('medida_id');
            $table->unsignedBigInteger('marca_id');
            $table->foreign('medida_id')->references('id')->on('medidas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogos');
    }
};
