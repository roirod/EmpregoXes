<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisclisTable extends Migration
{
    public function up()
    {
        Schema::create('regiscli', function (Blueprint $table) {
            $table->increments('idregcli');
            $table->integer('idcli')->unsigned();
            $table->integer('idasu')->unsigned();
            $table->date('fech');
            $table->text('notas')->nullable();            
            $table->timestamps();
            $table->index('fech');
            $table->foreign('idcli')
				      ->references('idcli')->on('clientes')
				      ->onDelete('cascade');
            $table->foreign('idasu')
                      ->references('idasu')->on('asuntos')
                      ->onDelete('cascade');                      
        });
    }
    
    public function down()
    {
        Schema::drop('regiscli');
    }
}
