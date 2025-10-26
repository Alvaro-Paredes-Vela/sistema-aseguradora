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
            $table->unsignedBigInteger('id_poliza');
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('ubicacion', 200)->nullable();
            $table->string('tipo_siniestro', 100)->nullable();
            $table->decimal('monto_estimado', 12, 2)->nullable();
            $table->string('estado', 50)->nullable();
            $table->foreign('id_poliza')->references('id_poliza')->on('policias')->onDelete('cascade');
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
