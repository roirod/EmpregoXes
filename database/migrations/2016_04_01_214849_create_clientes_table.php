<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{

    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('idcli');
            $table->string('nomcli', 88);
            $table->string('apecli', 111);
            $table->string('dni', 18);
            $table->string('naf', 18)->nullable();
            $table->string('email', 44)->nullable();
            $table->string('tel1', 18)->nullable();
            $table->string('tel2', 18)->nullable();
            $table->string('tel3', 18)->nullable();
            $table->string('sexo', 9)->nullable();
            $table->string('direc', 222)->nullable();
            $table->string('pobla', 222)->nullable();
            $table->date('fenac')->default('1950-01-01')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->index('apecli');
            $table->index('nomcli');
            $table->unique('dni');
        });
    }

    public function down()
    {
        Schema::drop('clientes');
    }
}
