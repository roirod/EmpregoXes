<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramclisTable extends Migration
{

    public function up()
    {
        Schema::create('programcli', function (Blueprint $table) {
            $table->increments('idprocli');
            $table->integer('idcli')->unsigned();
            $table->integer('idprog')->unsigned();
            $table->integer('idesp')->unsigned()->nullable(); 
            $table->date('feini');
            $table->date('fefin');
            $table->text('notas')->nullable();            
            $table->timestamps();
            $table->index('feini');
            $table->foreign('idcli')
				      ->references('idcli')->on('clientes')
				      ->onDelete('cascade');
            $table->foreign('idprog')
				      ->references('idprog')->on('programas')
				      ->onDelete('cascade');
            $table->foreign('idesp')
                      ->references('idesp')->on('especiali')
                      ->onDelete('cascade');                                           
        });
    }

    public function down()
    {
        Schema::drop('programcli');
    }
}
