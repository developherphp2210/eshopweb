<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profili', function (Blueprint $table) {
            $table->id();            
            $table->string('descrizione',25);
            /** PERMESSI CASSA */
            $table->smallInteger('versamenti')->default(0);
            $table->smallInteger('prelievi')->default(0);
            $table->smallInteger('richiama_scontrino')->default(0);
            $table->smallInteger('sospendi_scontrino')->default(0);
            $table->smallInteger('sconti')->default(0);
            $table->smallInteger('correzioni')->default(0);
            $table->smallInteger('annulla_scontrino')->default(0);
            $table->smallInteger('reso')->default(0);
            $table->smallInteger('gestione_fiscale')->default(0);
            $table->smallInteger('preconto')->default(0);
            $table->smallInteger('rapporti')->default(0);
            $table->smallInteger('scarico')->default(0);
            $table->smallInteger('fattura')->default(0);
            $table->smallInteger('scontrino')->default(0);
            $table->smallInteger('stampa_addestramenti')->default(0);

            /** PERMESSI FRONTEND */
            $table->smallInteger('anagrafiche')->default(0);
            $table->smallInteger('dashboard')->default(0);
            $table->smallInteger('cassieri')->default(0);
            $table->timestamps();
        });    

        DB::table('profili')->insert([
            ['descrizione' => 'ADMINISTRATOR',
            'versamenti' => 1,
            'prelievi' => 1,
            'richiama_scontrino' => 1,
            'sospendi_scontrino' => 1,
            'sconti' => 1,
            'correzioni' => 1,
            'annulla_scontrino' => 1,
            'reso' => 1,
            'gestione_fiscale' => 1,
            'preconto' => 1,
            'rapporti' => 1,
            'scarico' => 1,
            'fattura' => 1,            
            'scontrino' => 1,
            'stampa_addestramenti' => 1
            ],
            ['descrizione' => 'CASSIERE',
            'versamenti' => 1,
            'prelievi' => 0,
            'richiama_scontrino' => 1,
            'sospendi_scontrino' => 1,
            'sconti' => 0,
            'correzioni' => 1,
            'annulla_scontrino' => 0,
            'reso' => 0,
            'gestione_fiscale' => 1,
            'preconto' => 1,
            'rapporti' => 1,
            'scarico' => 1,
            'fattura' => 1,            
            'scontrino' => 1
            ]            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profili');
    }
};
