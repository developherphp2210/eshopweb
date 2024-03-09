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
        Schema::create('pagamenti', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('codice')->index('codtend')->unsigned();
            $table->string('descrizione',20)->nullable();
            $table->smallInteger('tipologia');
            $table->smallInteger('codice_sdi');
            $table->smallInteger('tipo_rt');
            $table->smallInteger('attivo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamenti');
    }
};
