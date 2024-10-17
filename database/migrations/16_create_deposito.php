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
        Schema::create('deposito', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();           
            $table->string('codice',10)->index('codrep')->unique();
            $table->string('descrizione',20);
            $table->bigInteger('id_listino')->index()->unsigned();
            $table->timestamps();
        });

        DB::table('deposito')->insert([
            ['id' => 0,
            'codice' => 0,
            'descrizione' => 'TUTTI I DEPOSITI',
            'id_listino' => 0
            ]            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposito');
    }
};
