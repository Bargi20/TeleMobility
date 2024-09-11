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
        Schema::create('Diagnosi', function (Blueprint $table) {
            $table->bigInteger('ID_Disturbo')->unsigned();
            $table->bigInteger('ID_Paziente')->unsigned();
            $table->boolean('Stato');

            $table->primary(['ID_Disturbo', 'ID_Paziente']); 

            // Vincoli esterni
            $table->foreign('ID_Disturbo')->references('Id_Disturbo')->on('Disturbo')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_Paziente')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('Diagnosi');
    }
};

 
   