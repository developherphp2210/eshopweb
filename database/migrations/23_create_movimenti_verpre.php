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
        Schema::create('movimenti_verpre', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('id_deposito')->index()->unsigned();
            $table->bigInteger('id_cassa')->index()->unsigned();
            $table->bigInteger('id_operatore')->index()->unsigned();
            $table->bigInteger('id_causale')->index()->unsigned();            
            $table->decimal('importo')->default(0);            
            $table->timestamp('data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimenti_verpre');
    }
};
