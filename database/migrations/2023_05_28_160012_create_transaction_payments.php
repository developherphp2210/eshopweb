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
        Schema::create('transaction_payments', function (Blueprint $table) {            
            $table->bigInteger('transaction_id')->index('trans_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transaction_header')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('payments_id')->index('codpay')->unsigned();
            $table->decimal('amount')->default(0);      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_payments');
    }
};
