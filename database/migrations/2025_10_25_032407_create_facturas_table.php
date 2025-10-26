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
            $table->id('id_factura');
            $table->unsignedBigInteger('id_venta');
            $table->string('nro_factura', 50)->unique();
            $table->date('fecha_emision')->default(\Carbon\Carbon::now());
            $table->decimal('monto_total', 12, 2);
            $table->decimal('monto_iva', 12, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('estado')->default(true);
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
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
