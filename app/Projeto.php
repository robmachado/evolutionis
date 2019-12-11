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

    public function getSituacaoAttribute()
    {
        switch ($this->status) {
            case 1:
                $txt = "Não iniciado";
                break;
            case 2:
                $txt = "Em andamento";
                break;
            case 9:
                $txt = "Encerrado Reprovado";
                break;
            default:
                $txt = "Finalizado Aprovado";
        }
        return $txt;
    }

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }
}
