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
        Schema::create('testata_volantino', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();
            $table->string('descrizione',50);
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->smallInteger('no_ticket')->default(0);
            $table->smallInteger('no_offtra')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testata_volantino');
    }
};
