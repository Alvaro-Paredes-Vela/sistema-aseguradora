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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('CI', 30)->nullable();
            $table->string('login', 50)->nullable();
            $table->string('password', 120)->nullable();
            $table->string('correo', 100)->nullable();
            $table->string('nombre', 50);
            $table->string('paterno', 50);
            $table->string('materno', 50);
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->boolean('estado')->default(true);
            $table->string('foto')->nullable(); // ruta de la foto del cliente (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
