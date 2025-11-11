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
        Schema::create('facturas', function (Blueprint $table) {
            $table->unsignedBigInteger('nro_factura')->primary();
            $table->date('fecha_emision');
            $table->decimal('monto', 10, 2);
            $table->decimal('monto_iva', 10, 2);
            $table->string('descripcion', 50);
            $table->string('estado', 30);
            $table->unsignedBigInteger('id_pago')->nullable();
            $table->foreign('id_pago')->references('id_pago')->on('pagos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
