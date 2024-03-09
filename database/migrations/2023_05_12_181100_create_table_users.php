<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email',50)->unique();
            $table->string('password');            
            $table->string('piva',11)->nullable();                        
            $table->char('type',1)->default('0');
            $table->rememberToken()->default('0');
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'email' => 'latorraca@infoetel.com',
                'password' => Hash::make('Giumax1976!'),
                'type' => '0'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
