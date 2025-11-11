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
        Schema::create('franquicias', function (Blueprint $table) {
            $table->id('id_franquicia');
            $table->string('nombre', 100)->nullable();
            $table->decimal('porcentaje_cobertura', 5, 2)->nullable();
            $table->decimal('monto_min', 12, 2)->nullable();
            $table->decimal('monto_max', 12, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('id_siniestro');
            $table->foreign('id_siniestro')->references('id_siniestro')->on('siniestros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franquicias');
    }
};
