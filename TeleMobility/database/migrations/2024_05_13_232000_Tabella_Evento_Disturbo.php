<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Evento_Disturbo', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('ID_Paziente')->unsigned();
            $table->bigInteger('ID_Disturbo')->unsigned();
            $table->date('Data_Evento');
            $table->string('Durata', 250);
            $table->double('Intensità');
            $table->time('Orario');

        
        
            // Vincoli esterni
            $table->foreign('ID_Paziente')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_Disturbo')->references('ID_Disturbo')->on('Disturbo')->onDelete('cascade')->onUpdate('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('Evento_Disturbo');
    }
};


