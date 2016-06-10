<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTituclisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titucli', function (Blueprint $table) {
            $table->increments('idtitcli');
            $table->integer('idcli')->unsigned();
            $table->integer('idtit')->unsigned();      
            $table->timestamps();
            $table->foreign('idcli')
                      ->references('idcli')->on('clientes')
                      ->onDelete('cascade');
            $table->foreign('idtit')
                      ->references('idtit')->on('titulos')
                      ->onDelete('cascade');                      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tituclis');
    }
}
