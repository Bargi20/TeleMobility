<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username',20)->unique('username');
            $table->string('password');
            $table->string('role',10)->default('user'); //ogni nuovo utente che si registra sarà assegnato all'user
            $table->date('DataDiNascita');
            $table->enum('Genere', ['M', 'F']);
            $table->string('Telefono', 10);
            $table->rememberToken();
            $table->timestamps();

            //clinico
            $table->text('Descrizione')->nullable();
            $table->text('Specializzazione')->nullable();
            $table->text('Immagine')->nullable();
            $table->enum('Ruolo_Clinico', ['Medico', 'Fisioterapista'])->nullable();
            //paziente
            $table->text('Terapia')->nullable();
            $table->integer('NumeroTerapia')->nullable();
            $table->bigInteger('ID_Clinico_Del_Paziente')->nullable();
            $table->text('Indirizzo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
