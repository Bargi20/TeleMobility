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
        Schema::create('Notifiche', function (Blueprint $table) {
            $table->bigIncrements('ID')->unsigned();
            $table->text('Messaggio');
            $table->BigInteger('ID_Ricevente')->unsigned();
            $table->date('DataNotifica');
            $table->time('Orario');
            $table->Integer('Aperta');
            

            $table->foreign('ID_Ricevente')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Notifiche');
    }
};
