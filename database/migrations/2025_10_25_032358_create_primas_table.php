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
        Schema::create('primas', function (Blueprint $table) {
            $table->id('id_prima');
            $table->decimal('monto', 12, 2);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('estado', 20)->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('id_poliza');
            $table->foreign('id_poliza')->references('id_poliza')->on('polizas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primas');
    }
};
