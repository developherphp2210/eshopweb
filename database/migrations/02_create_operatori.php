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
        Schema::create('operatori', function (Blueprint $table) {
            $table->id();                        
            $table->string('descrizione',20)->index('desoper');
            $table->string('password');
            $table->string('barcode',13)->nullable();
            $table->smallInteger('attivo')->default(1);
            $table->smallInteger('visibile_cassa')->default(0);
            $table->smallInteger('visibile_frontend')->default(0);
            $table->bigInteger('id_profilo')->index()->unsigned();
            $table->bigInteger('id_deposito')->index()->unsigned();           
            $table->timestamps();
        });

        DB::table('operatori')->insert(
            array(                
                'descrizione' => 'admin',
                'password' => 'admin',                
                'id_profilo' => '1',
                'visibile_frontend' => '1'
            )
        );

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operatori');
    }
};
