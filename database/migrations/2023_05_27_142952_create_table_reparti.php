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
            $table->string('codice',10)->index('codrep');
            $table->string('descrizione',20)->nullable();
            $table->smallInteger('posizione')->default(0);
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
