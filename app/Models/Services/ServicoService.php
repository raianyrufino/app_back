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

        $data = [
            'nome' => $nome, 
            'valor' => $valor,
        ];

        $this->servicoRepository->create($data);

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
}


