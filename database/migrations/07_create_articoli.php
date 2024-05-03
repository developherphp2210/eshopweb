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
        Schema::create('articoli', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();           
            $table->string('codice',13)->index('codart')->unique();
            $table->string('descrizione',30)->nullable();
            $table->string('des_breve',13)->nullable();
            $table->string('logo',20)->nullable();
            $table->bigInteger('id_reparto')->index('codrep')->unsigned(); 
            $table->foreign('id_reparto')->references('id')->on('reparti')->onUpdate('restrict')->onDelete('restrict');
            $table->smallInteger('tasto_rapido')->default(0);
            $table->bigInteger('id_iva')->index('codiva')->unsigned();
            $table->foreign('id_iva')->references('id')->on('iva')->onUpdate('restrict')->onDelete('restrict');
            $table->smallInteger('attivo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articoli');
    }
};
