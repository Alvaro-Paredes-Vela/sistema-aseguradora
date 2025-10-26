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
        Schema::create('seguros', function (Blueprint $table) {
            $table->id('id_seguro');
            $table->unsignedBigInteger('id_tipo_seguro');
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->string('nombre', 100)->nullable();
            $table->integer('vigencia')->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->foreign('id_tipo_seguro')->references('id_tipo_seguro')->on('tipos_seguro')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguros');
    }
};
