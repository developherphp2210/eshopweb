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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('riga1',40)->nullable();
            $table->string('riga2',40)->nullable();
            $table->string('riga3',40)->nullable();
            $table->string('riga4',40)->nullable();
            $table->string('riga5',40)->nullable();
            $table->string('riga6',40)->nullable();
            $table->string('testata',40)->nullable();
            $table->text('corpo')->nullable();
            $table->string('filepdf',15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
