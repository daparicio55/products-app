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
        Schema::create('catalogo_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('catalogo_id');
            $table->decimal('cantidad', 12, 2);
            $table->decimal('precio', 12, 2);
            $table->unique(['compra_id', 'catalogo_id']);
            $table->foreign('compra_id')->references('id')
            ->on('compras')
            ->onDelete('cascade');
            $table->foreign('catalogo_id')->references('id')
            ->on('catalogos');
            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_compra');
    }
};
