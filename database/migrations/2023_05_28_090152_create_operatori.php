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
        Schema::create('operatori', function (Blueprint $table) {
            $table->id();            
            $table->string('codice',10)->index('codoper');
            $table->string('descrizione',20)->index('desoper');
            $table->string('password');
            $table->string('barcode',13);
            $table->smallInteger('attivo')->default(1);
            // inserire profilo id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operatori');
    }
};
