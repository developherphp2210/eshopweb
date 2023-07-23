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
        Schema::create('transaction_body', function (Blueprint $table) {          
            $table->bigInteger('transaction_id')->index('trans_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transaction_header')->onUpdate('cascade')->onDelete('cascade');            
            $table->bigInteger('articles_id')->index('codart')->unsigned();
            $table->bigInteger('departments_id')->index('codrep')->unsigned();
            $table->bigInteger('vat_id')->index('codiva')->unsigned();
            $table->bigInteger('codean_id')->index('codean')->unsigned();
            $table->decimal('price')->default(0);
            $table->decimal('discounts')->default(0);
            $table->decimal('quantity')->default(1);        
            $table->string('type',1);
            $table->decimal('discounts_coupon')->default(0);         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_body');
    }
};
