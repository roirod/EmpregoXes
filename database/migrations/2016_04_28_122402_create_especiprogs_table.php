<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspeciprogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especiprog', function (Blueprint $table) {
            $table->increments('idesprog');
            $table->integer('idesp')->unsigned();
            $table->integer('idprog')->unsigned();          
            $table->timestamps();
            $table->foreign('idesp')
                      ->references('idesp')->on('especiali')
                      ->onDelete('cascade');
            $table->foreign('idprog')
                      ->references('idprog')->on('programas')
                      ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('especiprogs');
    }
}