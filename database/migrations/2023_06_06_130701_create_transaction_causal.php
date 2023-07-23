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
        Schema::create('transaction_causal', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('till_id')->index('tillid')->unsigned();
            $table->bigInteger('shop_id')->index('shopid')->unsigned();
            $table->bigInteger('cashier_id')->index('cashierid')->unsigned();
            $table->bigInteger('causal_id')->index('causalid')->unsigned();
            $table->bigInteger('payments_id')->index('codpay')->unsigned();
            $table->decimal('amount')->default(0);
            $table->integer('transaction_number');
            $table->timestamp('data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_causal');
    }
};
