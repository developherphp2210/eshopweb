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
        Schema::create('sconti', function (Blueprint $table) {
            $table->id();
            $table->string('codice',4)->index()->unique();
	        $table->string('descrizione',20)->nullable();
            $table->smallInteger('tipo')->default(1);
            $table->decimal('valore');
            $table->smallInteger('attivo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sconti');
    }
};
