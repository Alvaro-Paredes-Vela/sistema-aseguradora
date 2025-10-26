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
            $table->unsignedBigInteger('id_seguro');
            $table->string('placa', 15);
            $table->string('numero_poliza', 50)->unique();
            $table->date('fecha_emision')->default(\Carbon\Carbon::now());
            $table->date('fecha_vencimiento')->nullable();
            $table->string('estado', 20)->default('vigente');
            $table->foreign('id_seguro')->references('id_seguro')->on('seguros')->onDelete('cascade');
            $table->foreign('placa')->references('placa')->on('vehiculos')->onDelete('cascade');
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
