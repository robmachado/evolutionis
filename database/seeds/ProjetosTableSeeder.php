<?php

use App\Tarefa;
use App\Projeto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProjetosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Projeto::truncate();
        Tarefa::truncate();
        Schema::enableForeignKeyConstraints();
        factory(App\Projeto::class, 50)->create();
        factory(App\Tarefa::class, 150)->create();
    }
}
