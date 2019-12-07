<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tarefa;
use Faker\Generator as Faker;

$factory->define(Tarefa::class, function (Faker $faker) {
    $status = rand(0, 9);
    $motivo = null;
    if ($status > 2 && $status < 9) {
        $status == 1;
    }
    if ($status == 0) {
        $inicio = null;
        $previsao = null;
        $fim = null;
    } elseif ($status == 1) {
        $inicio = $faker->date($format = 'Y-m-d', $max = 'now');
        $previsao = $faker->dateTimeBetween($startDate = '+10 days', $endDate = '+100 days', $timezone = null);
        $fim = null;
    } elseif ($status == 2) {
        $inicio = $faker->date($format = 'Y-m-d', $max = 'now');
        $previsao = $faker->dateTimeBetween($startDate = '+10 days', $endDate = '+100 days', $timezone = null);
        $fim = $previsao;
        $motivo = 'Sucesso';
    } else {
        $inicio = $faker->date($format = 'Y-m-d', $max = 'now');
        $previsao = $faker->dateTimeBetween($startDate = '+10 days', $endDate = '+100 days', $timezone = null);
        $fim = $previsao;
        $motivo = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);
    }
    $id = rand(1,50);
    return [
        'projeto_id' => $id,
        'nome' => $faker->company,
        'detalhe' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'status' => $status, //0-não iniciado 1-em andamento 2-finalizado 9-encerrado com falha
        'responsavel' => $faker->name,
        'inicio' => $inicio,
        'previsao' => $previsao,
        'fim' => $fim,
        'motivo' => $motivo
    ];
});
