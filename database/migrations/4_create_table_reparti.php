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
        Schema::create('reparti', function (Blueprint $table) {
            $table->id();            
            $table->string('codice',10)->index('codrep')->unique();
            $table->string('descrizione',20)->nullable();
            $table->smallInteger('visibile')->default(0);
            $table->smallInteger('attivo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reparti');
    }
};
