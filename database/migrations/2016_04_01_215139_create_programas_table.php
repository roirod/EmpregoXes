<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasTable extends Migration
{
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->increments('idprog');
            $table->char('nomprog', 166);
            $table->date('feini');
            $table->date('fefin');
            $table->text('notas')->nullable();         
            $table->timestamps();
            $table->softDeletes();
            $table->index('feini');
            $table->unique('nomprog');
        });
    }

    public function down()
    {
        Schema::drop('programas');
    }
}
