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
         Schema::table('deposito', function (Blueprint $table) {            
            $table->string('riga1',40)->nullable();
            $table->string('riga2',40)->nullable();
            $table->string('riga3',40)->nullable();
            $table->string('riga4',40)->nullable();
            $table->string('riga5',40)->nullable();
            $table->string('riga6',40)->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
