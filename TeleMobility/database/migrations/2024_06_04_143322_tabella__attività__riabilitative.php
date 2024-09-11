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
        Schema::create('Attività_Riabilitative', function (Blueprint $table) {
            $table->bigIncrements('Id_Attività_Riabilitative')->unsigned();
            $table->string('Nome_Attività',250);
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
        Schema::dropIfExists('Attività_Riabilitative');
    }
};
