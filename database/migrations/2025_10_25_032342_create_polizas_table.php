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
        Schema::create('polizas', function (Blueprint $table) {
            $table->id('id_poliza');
            $table->string('numero_poliza', 30)->nullable();
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->string('estado', 15);
            $table->unsignedBigInteger('id_vehiculo');
            $table->unsignedBigInteger('id_seguro');
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_vehiculo')->references('id_vehiculo')->on('vehiculos')->onDelete('cascade');
            $table->foreign('id_seguro')->references('id_seguro')->on('seguros')->onDelete('cascade');
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polizas');
    }
};
