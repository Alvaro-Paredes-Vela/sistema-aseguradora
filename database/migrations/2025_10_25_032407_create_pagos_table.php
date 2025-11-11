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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->string('comprobante')->nullable();
            $table->enum('estado_pago', ['pendiente', 'confirmado', 'rechazado'])
                ->default('pendiente');
            $table->string('referencia', 100);
            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_prima')->nullable();
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            $table->foreign('id_prima')->references('id_prima')->on('primas');
            $table->unsignedBigInteger('confirmado_por')->nullable();
            $table->text('motivo_rechazo')->nullable();
            $table->foreign('confirmado_por')->references('id_empleado')->on('empleados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
