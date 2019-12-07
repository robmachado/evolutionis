<?php

namespace App;

use App\Tarefa;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'codigo',
        'finalidade',
        'status', //0-não iniciado 1-em andamento 2-finalizado 9-encerrado com falha
        'inicio',
        'previsao',
        'fim',
        'motivo'
    ];

    protected $dates = [
        'inicio',
        'previsao',
        'fim'
    ];

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }
}
