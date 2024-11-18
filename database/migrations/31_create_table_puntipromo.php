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
        Schema::create('puntipromo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_promo')->index()->unsigned();
            $table->foreign('id_promo')->references('id')->on('promozioni')->onUpdate('restrict')->onDelete('restrict');
            $table->bigInteger('id_fidelity')->index()->unsigned();
            $table->foreign('id_fidelity')->references('id')->on('fidelity_card')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('punti')->default(0);            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntipromo');
    }
};
