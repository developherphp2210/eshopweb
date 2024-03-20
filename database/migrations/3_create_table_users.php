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
            $table->bigInteger('id_operatore')->index('oper_id')->unsigned()->nullable()->default(0);
            $table->bigInteger('id_cliente')->index('cli_id')->unsigned()->nullable()->default(0);
            $table->string('user_name',50)->unique();
            $table->string('password');                                                
            $table->char('type',1)->default('0');            
            $table->string('nome',50)->nullable();
            $table->string('cognome',50)->nullable();            
            $table->string('indirizzo',250)->nullable();
            $table->string('citta',50)->nullable();
            $table->string('cap',5)->nullable();
            $table->string('telefono',15)->nullable();            
            $table->string('codice_fiscale',16)->nullable();
            $table->string('piva',11)->nullable();
            $table->string('prov',2)->nullable();
            $table->string('image')->nullable();
            $table->smallInteger('primo_accesso')->default(0);
            $table->rememberToken();                     
            $table->timestamps();
        }); 
        
        DB::table('users')->insert(
            array(                
                'user_name' => 'admin',
                'password' => Hash::make('Oasi7676!'),                
                'id_operatore' => '1'                
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
