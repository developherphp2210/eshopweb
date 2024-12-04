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
        Schema::create('volantinopdf', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('attivo')->default(1);
            $table->bigInteger('id_deposito')->index()->unsigned();
            $table->foreign('id_deposito')->references('id')->on('deposito')->onUpdate('restrict')->onDelete('restrict');
            $table->string('nome',30);
            $table->string('path',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volantinopdf');
    }
};
