<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Entities\{Procedimento, Servico};
use App\Models\Enum\TipoComissao;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicos')->insert([
            ['nome' => 'Exame de Sangue', 'valor' => 20.00],
            ['nome' => 'Consulta de vista', 'valor' => 70.00],
            ['nome' => 'Consulta médica', 'valor' => 120.00],
            ['nome' => 'Exame simples', 'valor' => 50.00],
        ]);

        DB::table('procedimentos')->insert([
            ['nome' => 'Correção da córnea', 'valor' => 00.00],
            ['nome' => 'Exame completo', 'valor' => 00.00],
            ['nome' => 'Exame de rotina', 'valor' => 00.00],
        ]);

        $servicos = Servico::all();

        Procedimento::all()->each(function ($procedimento) use ($servicos) { 
            $servicos_random = $servicos->random(rand(1, 3));
            $procedimento->servicos()->attach($servicos_random); 

            $valor = 00.00;
            foreach ($servicos_random as $servico) {
                $valor += $servico->valor;
            }

            $procedimento->valor = $valor;
            $procedimento->comissao = ($valor * TipoComissao::PADRAO);
            $procedimento->save();
        });
    }
}
