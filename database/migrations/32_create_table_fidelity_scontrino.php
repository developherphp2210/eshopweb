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
        Schema::create('fidelity_scontrino', function (Blueprint $table) {
            $table->bigInteger('id_testata')->index('trans_id')->unsigned();
            $table->foreign('id_testata')->references('id')->on('testata_scontrino')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('id_promo')->index('idpromo')->unsigned();
            $table->foreign('id_promo')->references('id')->on('promozioni')->onUpdate('restrict')->onDelete('restrict');    
			$table->bigInteger('id_fidelity')->index('idfidelity')->unsigned();			
            $table->foreign('id_fidelity')->references('id')->on('fidelity_card')->onUpdate('restrict')->onDelete('restrict');    
			$table->Integer('punti_precedenti')->default(0);			
			$table->Integer('punti_accumulati')->default(0);
			$table->Integer('punti_jolly')->default(0);
			$table->Integer('punti_senza_Accumulo')->default(0);
			$table->bigInteger('id_offerta')->index('idofferta')->unsigned();
            $table->foreign('id_offerta')->references('id')->on('tipi_offerte')->onUpdate('restrict')->onDelete('restrict');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fidelity_scontrino');
    }
};
