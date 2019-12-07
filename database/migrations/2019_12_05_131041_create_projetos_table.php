<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('nome', 100)->index();
            $table->text('descricao')->nullable();
            $table->string('codigo', 7)->unique();
            $table->text('finalidade')->nullable();
            $table->tinyInteger('status')->default(0)->unsigned();
            $table->date('inicio')->nullable();
            $table->date('previsao')->nullable();
            $table->date('fim')->nullable();
            $table->text('motivo')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projetos');
    }
}
