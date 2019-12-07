<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('projeto_id')->unsigned();
            $table->string('nome', 100);
            $table->text('detalhe')->nullable();
            $table->tinyInteger('status')->default(0)->unsigned();
            $table->string('responsavel', 50)->nullable();
            $table->date('inicio')->nullable();
            $table->date('previsao')->nullable();
            $table->date('fim')->nullable();
            $table->text('motivo')->nullable();
            $table->timestamps();
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}
