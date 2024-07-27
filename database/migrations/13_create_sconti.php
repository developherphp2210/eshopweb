<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sconti', function (Blueprint $table) {
            $table->id();
            $table->string('codice',4)->index()->unique();
	        $table->string('descrizione',30)->nullable();
            $table->smallInteger('tipo')->default(1);
            $table->decimal('valore');
            $table->smallInteger('attivo')->default(1);
            $table->timestamps();
        });

        DB::table('sconti')->insert([
            [                
                'codice' => '1',
                'descrizione' => 'SCONTO AMMONTARE',                
                'tipo' => '2',
                'valore' => '0',
                'attivo' => '1'
            ],
            [
                'codice' => '2',
                'descrizione' => 'SCONTO %',                
                'tipo' => '1',
                'valore' => '0',
                'attivo' => '1'
            ]
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sconti');
    }
};
