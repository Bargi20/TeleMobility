<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('Messaggi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_destinatario')->unsigned();
            $table->bigInteger('id_mittente')->unsigned();
            $table->text('corpo');
            $table->text('contenuto');
            $table->boolean('aperto');
            $table->dateTime('orario')->nullable();
            $table->bigInteger('id_risposta')->nullable();
            
            $table->foreign('id_destinatario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_mittente')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Messaggi');
    }
};
