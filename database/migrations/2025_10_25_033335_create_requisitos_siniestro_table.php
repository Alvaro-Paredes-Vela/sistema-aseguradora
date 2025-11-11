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
        Schema::create('requisitos_siniestro', function (Blueprint $table) {
            $table->char('obligatorio', 1)->default('N');
            $table->unsignedBigInteger('id_siniestro');
            $table->unsignedBigInteger('id_requisito');
            $table->primary(['id_siniestro', 'id_requisito']);
            $table->foreign('id_siniestro')->references('id_siniestro')->on('siniestros')->onDelete('cascade');
            $table->foreign('id_requisito')->references('id_requisito')->on('requisitos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitos_siniestro');
    }
};
