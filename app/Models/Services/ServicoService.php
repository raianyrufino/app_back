<?php

namespace App\Models\Services;

use App\Models\Repositories\ServicoRepository;
use App\Exceptions\BusinessException;

class ServicoService
{
    public function __construct(ServicoRepository $servicoRepository)
    {
        $this->servicoRepository = $servicoRepository;
    }

    public function register($nome, $valor)
    {   
        $servico = $this->servicoRepository->findBy('nome', $nome);
        
        if ($servico) {
            throw new BusinessException("Serviço já registrado.", 406);
        }

        $dados = [
            'nome' => $nome, 
            'valor' => $valor,
        ];

        $this->servicoRepository->create($dados);

        return 'Serviço registrado com sucesso.';
    }

    public function getAll()
    {
        $servicos = $this->servicoRepository->getAllWithPagination(10);

        if(!$servicos){
            throw new BusinessException("Não há serviços registrados.", 404);
        }

        return response()->json($servicos);
    }

    public function getValue($procedimento_id, $servicos) 
    {
        $valor = 00.00;

        foreach ($servicos as $servico) {
            $servico_encontrado = $this->servicoRepository->findBy('id', $servico);
            $servico_encontrado->procedimentos()->attach($procedimento_id);

            $valor += $servico_encontrado->valor;
        }

        return $valor;
    }
}


