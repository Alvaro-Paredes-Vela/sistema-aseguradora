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
        Schema::create('requisitos_seguros', function (Blueprint $table) {
            $table->char('obligatorio', 1);
            $table->unsignedBigInteger('id_seguro');
            $table->unsignedBigInteger('id_requisito');
            $table->primary(['id_seguro', 'id_requisito']);
            $table->foreign('id_seguro')->references('id_seguro')->on('seguros')->onDelete('cascade');
            $table->foreign('id_requisito')->references('id_requisito')->on('requisitos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitos_seguros');
    }
};
