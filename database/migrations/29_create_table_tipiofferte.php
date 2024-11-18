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
        Schema::create('tipi_offerte', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();
            $table->bigInteger('id_deposito')->index()->unsigned();
            $table->integer('codice_Offerta');
            $table->string('descrizione',30);
            $table->integer('applicabilita');
            $table->integer('nrVolte')->default(0);
            $table->integer('tipo_Offerta');
            $table->integer('offerta_Cumulativa');
            $table->integer('soglia_Qta')->default(0);
            $table->double('soglia_Ammontare',6,2)->default(0);
            $table->double('soglia_Sbt',6,2)->default(0);
            // "tipo": "N",
            $table->double('esito',6,2);
            // "claliOff": 0,
            $table->date('data_Inizio')->nullable();
            $table->date('data_Fine')->nullable();
            $table->integer('soglia_Bollino')->default(0);
            // "post": false,
            $table->biginteger('promo')->unsigned()->default(1);
            $table->integer('lunedi');
            $table->integer('martedi');
            $table->integer('mercoledi');
            $table->integer('giovedi');
            $table->integer('venerdi');
            $table->integer('sabato');
            $table->integer('domenica');
            $table->time('ora_Ini')->nullable();
            $table->time('ora_Fine')->nullable();
            $table->integer('livello')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipi_offerte', function (Blueprint $table) {
            //
        });
    }
};
