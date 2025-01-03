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
        Schema::create('depositi_volantino', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_deposito')->unsigned()->index();
            $table->foreign('id_deposito')->references('id')->on('deposito')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('id_testata')->index()->unsigned();
            $table->foreign('id_testata')->references('id')->on('testata_volantino')->onUpdate('cascade')->onDelete('cascade');                        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depositi_volantino');
    }
};
