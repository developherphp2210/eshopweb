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
            $table->bigInteger('ideshop')->index()->unsigned();            
            $table->string('codice',13)->index('cod_fid');
            $table->string('ragsoc',40)->nullable();
            $table->string('ragsoc1',40)->nullable();
            $table->string('indirizzo',30)->nullable();
            $table->string('cap',5)->nullable();
            $table->string('citta',30)->nullable();
            $table->string('prov',2)->nullable();
            $table->string('tel',15)->nullable();
            $table->string('codfisc',16)->nullable();           
            $table->string('piva',11)->nullable();           
            $table->string('email',40)->nullable();            
            $table->integer('punti')->nullable();            
            $table->decimal('totale_vendita')->nullable();
            $table->date('data_ultimo_scontrino')->nullable();            
            $table->string('cel',15)->nullable();
            $table->string('pec',40)->nullable();                        
            $table->string('sdi',7)->nullable();
            $table->string('ipa',6)->nullable();
            $table->smallInteger('split')->nullable();  
            $table->bigInteger('id_listino')->unsigned()->index()->nullable();

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
