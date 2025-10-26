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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id('id_cotizacion');
            $table->unsignedBigInteger('id_seguro');
            $table->string('placa', 15);
            $table->decimal('precio_total', 12, 2);
            $table->decimal('cuota_inicial', 12, 2)->nullable();
            $table->date('fecha')->default(\Carbon\Carbon::now());
            $table->integer('total_subcuotas')->nullable();
            $table->float('subcuotas')->nullable();
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
        Schema::dropIfExists('cotizaciones');
    }
};
