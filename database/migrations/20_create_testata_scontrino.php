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
            $table->bigInteger('id_cassa')->index()->unsigned();
            $table->bigInteger('id_cliente')->index()->unsigned()->default(0);
            $table->bigInteger('id_operatore')->index('cashierid')->unsigned();
            $table->decimal('importo')->default(0);
            $table->timestamp('data')->index();            
            $table->integer('numero_scontrino');
            $table->smallinteger('punti')->default(0);
            $table->smallinteger('punti_jolly')->default(0);
            $table->string('causale_documento',2);
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
