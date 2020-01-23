<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceps', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('cep')->nullable();
            $table->boolean('situacao')->nullable();
            $table->integer('bairro_id')->unsigned()->nullable();
            $table->foreign('bairro_id')->references('id')->on('bairros');
            $table->integer('logradouro_id')->unsigned()->nullable();
            $table->foreign('logradouro_id')->references('id')->on('logradouros');
            $table->integer('cidade_id')->unsigned()->nullable();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ceps');
    }
}
