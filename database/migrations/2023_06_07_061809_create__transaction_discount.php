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
        Schema::create('transaction_discount', function (Blueprint $table) {
            $table->bigInteger('transaction_id')->index('trans_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transaction_header')->onUpdate('cascade')->onDelete('cascade');
            $table->string('description',30)->nullable();
            $table->decimal('discount')->default(0);
            $table->string('type',1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_discount');
    }
};
