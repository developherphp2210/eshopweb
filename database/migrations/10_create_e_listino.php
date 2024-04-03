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
        Schema::create('e_listino', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();
            $table->bigInteger('id_rlistino')->unsigned()->index();          
            $table->bigInteger('id_ean')->unsigned()->index();          
            $table->double('przlor');          
            $table->double('sconto1')->default(0);
            $table->double('sconto2')->default(0);
            $table->double('sconto3')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_listino');
    }
};
