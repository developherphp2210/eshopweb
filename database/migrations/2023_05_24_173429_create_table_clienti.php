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
        Schema::create('clienti', function (Blueprint $table) {
            $table->id();            
            $table->string('codice_fidelity',13)->index('cod_fid');
            $table->string('ragsoc',40)->nullable();
            $table->string('indirizzo',30)->nullable();
            $table->string('cap',5)->nullable();
            $table->string('citta',30)->nullable();
            $table->string('prov',2)->nullable();
            $table->string('tel',15)->nullable();
            $table->string('codfisc',16)->nullable();           
            $table->string('email',40)->nullable();            
            $table->integer('punti')->nullable();            
            $table->decimal('totale_vendita')->nullable();
            $table->date('data_ultimo_scontrino')->nullable();            
            $table->string('cel',15)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clienti');
    }
};
