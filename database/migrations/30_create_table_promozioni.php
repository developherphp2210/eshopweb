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
        Schema::create('promozioni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_deposito')->nullable()->unsigned();
            $table->string('descrizione',30);
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promozioni');
    }
};
