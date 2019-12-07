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

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }
}
