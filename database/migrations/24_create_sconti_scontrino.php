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
        Schema::create('sconti_scontrino', function (Blueprint $table) {
            $table->bigInteger('id_testata')->index('trans_id')->unsigned();
            $table->foreign('id_testata')->references('id')->on('testata_scontrino')->onUpdate('cascade')->onDelete('cascade');   
            $table->bigInteger('id_sconti')->index();
            $table->bigInteger('id_corpo')->index();
            $table->decimal('importo')->default(0);            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sconti_scontrino');
    }
};
