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
        Schema::create('codean', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();           
            $table->string('barcode',13)->index();
            $table->string('descrizione',20);
            $table->bigInteger('id_articolo')->index('codart')->unsigned();
            $table->foreign('id_articolo')->references('id')->on('articoli')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('prezzo_special')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codean');
    }
};
