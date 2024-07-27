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
        Schema::create('pagamenti_scontrino', function (Blueprint $table) {            
            $table->bigInteger('id_testata')->index('trans_id')->unsigned();
            $table->foreign('id_testata')->references('id')->on('testata_scontrino')->onUpdate('cascade')->onDelete('cascade');   
            $table->bigInteger('id_pagamenti')->index('codpay')->unsigned();
            $table->foreign('id_pagamenti')->references('id')->on('pagamenti')->onUpdate('restrict')->onDelete('restrict');    
            $table->decimal('importo')->default(0);      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamenti_scontrino');
    }
};
