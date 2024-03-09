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
        Schema::table('users',function(Blueprint $table){
            $table->string('firstname',50)->nullable();
            $table->string('lastname',50)->nullable();
            $table->string('business_name',250)->nullable();
            $table->string('address',250)->nullable();
            $table->string('city',50)->nullable();
            $table->string('cap',5)->nullable();
            $table->string('phone',15)->nullable();            
            $table->string('codfisc',16)->nullable();
            $table->string('district',2)->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
