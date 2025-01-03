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
        Schema::create('corpo_volantino', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();
            $table->bigInteger('id_testata')->unsigned()->index();            
            $table->foreign('id_testata')->references('id')->on('testata_volantino')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('id_articolo')->unsigned()->index();
            $table->bigInteger('id_offerta')->index()->unsigned();
            $table->decimal('prezzo_iniziale');
            $table->decimal('prezzo_offerta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corpo_volantino');
    }
};
