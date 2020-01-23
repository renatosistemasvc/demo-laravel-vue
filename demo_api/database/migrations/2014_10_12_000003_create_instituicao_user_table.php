<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicaoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao_user', function (Blueprint $table) {

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade');

            $table->integer('instituicao_id')->unsigned()->nullable();
            $table->foreign('instituicao_id')->references('id')
                    ->on('instituicoes')->onDelete('cascade');

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
        Schema::dropIfExists('instituicao_user');
    }
}
