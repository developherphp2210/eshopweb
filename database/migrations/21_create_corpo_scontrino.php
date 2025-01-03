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
        Schema::create('corpo_scontrino', function (Blueprint $table) {          
            $table->id();
            $table->bigInteger('id_testata')->index('trans_id')->unsigned();
            $table->foreign('id_testata')->references('id')->on('testata_scontrino')->onUpdate('cascade')->onDelete('cascade');            
            $table->bigInteger('id_articolo')->index('codart')->unsigned();
            $table->bigInteger('id_reparto')->index('codrep')->unsigned();
            $table->bigInteger('id_iva')->index('codiva')->unsigned();
            $table->bigInteger('id_codean')->index('codean')->unsigned();
            $table->decimal('prezzo')->default(0);
            $table->smallInteger('presenza_sconto')->default(0);
            $table->smallInteger('presenza_offerta')->default(0);
            $table->decimal('quantita')->default(1);        
            $table->string('causale',1);
            $table->decimal('sconto_art',8,3)->default(0);
            $table->decimal('sconto_tra',8,3)->default(0);            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corpo_scontrino');
    }
};
