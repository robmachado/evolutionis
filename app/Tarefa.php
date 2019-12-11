<?php

namespace App;

use App\Projeto;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = [
        'projeto_id',
        'nome',
        'detalhe',
        'status', //0-não iniciado 1-em andamento 2-finalizado 9-encerrado com falha
        'responsavel',
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

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }
}
