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
        Schema::create('siniestros', function (Blueprint $table) {
            $table->id('id_siniestro');
            $table->date('fecha');
            $table->string('descripcion', 450);
            $table->string('ubicacion', 200);
            $table->time('hora');
            $table->decimal('monto_estimado', 10, 2);
            $table->string('estado', 15);
            $table->unsignedBigInteger('id_poliza');
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_poliza')->references('id_poliza')->on('polizas')->onDelete('cascade');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siniestros');
    }
};
