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
        Schema::create('fidelity_clienti', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cliente')->index()->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clienti')->onUpdate('restrict')->onDelete('restrict');
            $table->bigInteger('id_fidelity')->index()->unsigned();
            $table->foreign('id_fidelity')->references('id')->on('fidelity_card')->onUpdate('restrict')->onDelete('restrict');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fidelity_clienti');
    }
};
