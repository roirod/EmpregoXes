<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asuntos', function (Blueprint $table) {
            $table->increments('idasu');
            $table->char('nomasu', 166);
            $table->timestamps();
            $table->unique('nomasu');            
        });
    }

    public function down()
    {
        Schema::drop('asuntos');
    }
}
