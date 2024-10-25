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
        Schema::create('fidelity_card', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_linea')->index()->unsigned();
            $table->foreign('id_linea')->references('id')->on('lineafidelity')->onUpdate('restrict')->onDelete('restrict');
            $table->string('codice',13)->nullable()->unique();
            $table->string('descrizione',30);
            $table->smallInteger('livello');
            $table->integer('punti')->default(0);
            $table->decimal('saldo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fidelity_card');
    }
};
