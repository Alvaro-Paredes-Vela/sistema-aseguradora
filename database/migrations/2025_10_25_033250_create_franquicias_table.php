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
            $table->string('nombre', 100); // ej: "Franquicia Estándar 500 Bs"
            $table->decimal('monto', 10, 2)->nullable();        // ej: 500.00
            $table->decimal('porcentaje', 5, 2)->nullable();     // ej: 5.00
            $table->text('descripcion')->nullable();

            // UNA sola franquicia por póliza
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
        Schema::dropIfExists('franquicias');
    }
};
