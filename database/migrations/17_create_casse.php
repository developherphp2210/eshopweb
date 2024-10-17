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
        Schema::create('casse', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('id_deposito')->index()->unsigned();
            $table->foreign('id_deposito')->references('id')->on('deposito')->onUpdate('restrict')->onDelete('restrict');
            $table->string('codice',10)->index('codep');
            $table->string('descrizione',20)->nullable();
            $table->char('aggiorna_backend',1)->default('0');
            $table->char('aggiorna_frontend',1)->default('0');
            $table->timestamp('lastupdate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casse');
    }
};
