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
        Schema::table('testata_scontrino',function(Blueprint $table){
            $table->integer('numero_fattura')->default(0);
            $table->string('registro_fattura',5)->nullable();
            $table->integer('riferimento_scontrino')->default(0);
            $table->smallInteger('scontrino_annullato')->default(0);
            $table->timestamp('data_annullo')->nullable();
            $table->bigInteger('operatore_annullo')->unsigned()->nullable()->default(0);
            $table->bigInteger('id_fidelity')->index()->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
