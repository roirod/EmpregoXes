<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especiali', function (Blueprint $table) {
            $table->increments('idesp');
            $table->char('nomesp', 166);
            $table->timestamps();
            $table->unique('nomesp');
        });
    }

    public function down()
    {
        Schema::drop('especiali');
    }
}
