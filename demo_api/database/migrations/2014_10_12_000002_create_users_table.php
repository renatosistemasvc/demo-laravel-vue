<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('imagem')->nullable();
            $table->string('usuario')->unique();
            $table->boolean('situacao')->nullable();
            $table->timestamp('usuario_verified_at')->nullable();
            $table->string('password');
            $table->integer('instituicao_id')->unsigned()->nullable();
            $table->foreign('instituicao_id')->references('id')->on('instituicoes');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'ADMINISTRADOR',
            'usuario' => 'admin',
            'password' => bcrypt('123123'),
            'situacao' => true
        ]);

        DB::select(DB::raw("SELECT setval('users_id_seq', (SELECT MAX(id) from users))"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
