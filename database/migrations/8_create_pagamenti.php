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
            $table->bigInteger('codice')->index('codtend')->unsigned()->unique();
            $table->string('descrizione',20)->nullable();
            $table->smallInteger('tipologia')->defaul(1);
            $table->smallInteger('codice_sdi')->defaul(1);
            $table->smallInteger('tipo_rt')->defaul(1);
            $table->smallInteger('attivo')->default(1);
            $table->timestamps();
        });

        DB::table('pagamenti')->insert([
            [                
                'codice' => '1',
                'descrizione' => 'CONTANTI',                
                'tipologia' => '1'                
            ],
            [
                'codice' => '2',
                'descrizione' => 'BANCOMAT',                
                'tipologia' => '2'           
            ]
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamenti');
    }
};
