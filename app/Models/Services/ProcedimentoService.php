<?php

namespace App\Models\Services;

use App\Models\Repositories\{ProcedimentoRepository, ServicoRepository};
use App\Exceptions\BusinessException;

class ProcedimentoService
{
    public function __construct(ProcedimentoRepository $procedimentoRepository, ServicoRepository $servicoRepository)
    {
        $this->procedimentoRepository = $procedimentoRepository;
        $this->servicoRepository = $servicoRepository;
    }

    public function register($nome, $servicos)
    {   
        $procedimento = $this->procedimentoRepository->findBy('nome', $nome);
        
        if ($procedimento) {
            throw new BusinessException("Procedimento já registrado.", 406);
        }

        $valor = 00.00;

        $data = [
            'nome' => $nome, 
            'valor' => $valor, 
        ];

        $procedimento_created = $this->procedimentoRepository->create($data);

        foreach ($servicos as $servico) {
            $servico_found = $this->servicoRepository->findBy('id', $servico);

            $valor += $servico_found->valor;
            $servico_found->procedimentos()->attach($procedimento_created->id);
        }

        $this->procedimentoRepository->update(['valor' => $valor], $procedimento_created->id);

        return 'Procedimento registrado com sucesso.';
    }

    public function getAll()
    {
        $procedimentos = $this->procedimentoRepository->getWithServicos(10);

        if(!$procedimentos){
            throw new BusinessException("Não há procedimentos registrados.", 404);
        }

        return response()->json($procedimentos);
    }

    public function getById($id)
    {
        $procedimento = $this->procedimentoRepository->getWithServicosById($id);
        
        if (!$procedimento) {
            throw new BusinessException("Procedimento não encontrado.", 404);
        }

        return response()->json($procedimento);
    }
}


