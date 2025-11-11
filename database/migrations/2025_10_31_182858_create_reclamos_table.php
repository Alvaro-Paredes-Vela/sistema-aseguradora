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
        Schema::create('reclamos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 100);
            $table->text('mensaje');
            $table->date('fecha_reclamo')->useCurrent();
            $table->enum('estado', ['pendiente', 'en_proceso', 'resuelto', 'rechazado'])->default('pendiente');
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->unsignedBigInteger('id_empleado')->nullable();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamos');
    }
};
