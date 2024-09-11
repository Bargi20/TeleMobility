<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Farmaci', function (Blueprint $table) {
            $table->bigIncrements('ID_Farmaco')->unsigned();
            $table->string('Nome_Farmaco', 250);
            $table->text('Descrizione');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('Farmaci');
    }
};
