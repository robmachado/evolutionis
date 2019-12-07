<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Projeto;
use Faker\Generator as Faker;

$factory->define(Projeto::class, function (Faker $faker) {
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

    return [
        'user_id' => rand(1,3),
        'nome' => $faker->company,
        'descricao' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'codigo' => $faker->numberBetween($min = 2000, $max = 2999) . $faker->randomLetter(),
        'finalidade' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'status' => $status, //0-não iniciado 1-em andamento 2-finalizado 9-encerrado com falha
        'inicio' => $inicio,
        'previsao' => $previsao,
        'fim' => $fim,
        'motivo' => $motivo
    ];
});
