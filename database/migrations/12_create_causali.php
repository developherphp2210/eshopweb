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
        Schema::create('causali', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();
            $table->smallInteger('attivo')->default(1);           
            $table->string('codice',6)->index();
            $table->string('descrizione',30);
            $table->char('type',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('causali');
    }
};
