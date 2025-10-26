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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->string('login', 50)->unique()->notNullable();
            $table->string('clave', 100)->notNullable();
            $table->string('correo', 100)->notNullable();
            $table->string('rol', 100)->notNullable();
            $table->date('contratacion')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('nombres', 50);
            $table->string('paterno', 50);
            $table->string('materno', 50);
            $table->string('nro_telefono', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
