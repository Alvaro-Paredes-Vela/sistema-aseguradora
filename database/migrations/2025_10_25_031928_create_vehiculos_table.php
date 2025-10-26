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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->string('placa', 15)->primary();
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_modelo');
            $table->integer('anio_fabricacion')->nullable();
            $table->string('color', 50)->nullable();
            $table->string('nro_chasis', 50)->nullable();
            $table->string('nro_motor', 50)->nullable();
            $table->integer('cilindrada')->nullable();
            $table->string('tipo_vehiculo', 50)->nullable();
            $table->string('tipo_combustible', 50)->nullable();
            $table->integer('kilometraje')->nullable();
            $table->decimal('valor_comercial', 12, 2)->nullable();
            $table->string('estado', 20)->default('activo');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_marca')->references('id_marca')->on('marcas')->onDelete('cascade');
            $table->foreign('id_modelo')->references('id_modelo')->on('modelos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
