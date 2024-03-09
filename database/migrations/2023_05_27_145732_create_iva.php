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
        Schema::create('iva', function (Blueprint $table) {
            $table->id();                      
            $table->string('codice',6)->index('codiva');
	        $table->string('descrizione',25)->nullable();
	        $table->integer('aliquota');
            $table->integer('reparto_fiscale');
            $table->smallInteger('attivo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iva');
    }
};
