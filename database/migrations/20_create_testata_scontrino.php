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
        Schema::create('testata_scontrino', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('id_deposito')->index()->unsigned();
            $table->foreign('id_deposito')->references('id')->on('deposito')->onUpdate('restrict')->onDelete('restrict');
            $table->bigInteger('id_cassa')->index()->unsigned();
            $table->foreign('id_cassa')->references('id')->on('casse')->onUpdate('restrict')->onDelete('restrict');
            $table->bigInteger('id_cliente')->index()->unsigned()->default(0);            
            $table->bigInteger('id_operatore')->index()->unsigned();
            $table->foreign('id_operatore')->references('id')->on('operatori')->onUpdate('restrict')->onDelete('restrict');
            $table->decimal('importo')->default(0);
            $table->timestamp('data')->index();            
            $table->integer('numero_scontrino')->nullable();
            $table->smallinteger('punti')->default(0);
            $table->smallinteger('punti_jolly')->default(0);
            $table->string('causale_documento',2)->index();
            $table->integer('numero_chiusura')->nullable();
            $table->string('matricola_fiscale',12)->nullable();
            $table->decimal('sconto_art',8,3)->default(0);
            $table->decimal('sconto_tra',8,3)->default(0);
            $table->smallInteger('rileva_venduto')->default(0)->index();
            $table->integer('numero_fattura')->default(0);
            $table->string('registro_fattura',5)->nullable();
            $table->integer('riferimento_scontrino')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testata_scontrino');
    }
};
