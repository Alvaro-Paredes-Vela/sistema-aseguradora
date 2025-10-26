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
        Schema::create('tipos_seguro', function (Blueprint $table) {
            $table->id('id_tipo_seguro');
            $table->string('nombre', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('nivel_riesgo', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_seguro');
    }
};
