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
            $table->string('login', 50)->unique()->notNullable();
            $table->string('password', 120);
            $table->string('correo', 100)->nullable();
            $table->string('nombres', 50);
            $table->string('paterno', 50);
            $table->string('materno', 50);
            $table->string('direccion', 100)->nullable();
            $table->string('nro_telefono', 15)->nullable();
            $table->boolean('estado')->default(true);
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
