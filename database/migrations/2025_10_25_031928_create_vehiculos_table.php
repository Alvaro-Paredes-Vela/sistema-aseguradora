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
            $table->id('id_vehiculo');
            $table->string('placa', 15)->unique();
            $table->integer('anio_fabricacion')->nullable();
            $table->string('color', 50)->nullable();
            $table->string('nro_chasis', 50)->nullable();
            $table->string('nro_motor', 50)->nullable();
            $table->integer('cilindrada')->nullable();
            $table->string('RUAT', 70)->nullable();
            // TIPOS OFICIALES SOAT 2025
            $table->enum('tipo_vehiculo', [
                'motocicleta',
                'automovil',
                'jeep',
                'camioneta',
                'vagoneta',
                'microbus',
                'colectivo',
                'omnibus_flota',
                'tracto_camion',
                'minibus_8',
                'minibus_11',
                'minibus_15',
                'camion_3',
                'camion_18',
                'camion_25'
            ])->nullable();

            $table->enum('uso_vehiculo', ['particular', 'publico'])->default('particular');
            $table->enum('region', [
                'santa_cruz',
                'la_paz',
                'cochabamba',
                'oruro',
                'potosi',
                'beni',
                'pando',
                'chuquisaca',
                'tarija'
            ])->default('santa_cruz');

            $table->string('tipo_combustible', 50)->nullable();
            $table->integer('kilometraje')->nullable();
            $table->decimal('valor_comercial', 12, 2)->nullable();
            $table->string('estado', 20)->default('activo');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('id_modelo');
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
