<?php

namespace App\Models\Services;

use App\Models\Repositories\ProcedimentoRepository;
use App\Models\Services\ServicoService;
use App\Exceptions\BusinessException;
use App\Models\Enum\TipoComissao;

class ProcedimentoService
{
    public function __construct(ProcedimentoRepository $procedimentoRepository, ServicoService $servicoService)
    {
        $this->procedimentoRepository = $procedimentoRepository;
        $this->servicoService = $servicoService;
    }

    public function register($nome, $servicos)
    {   
        $procedimento = $this->procedimentoRepository->findBy('nome', $nome);
        
        if ($procedimento) {
            throw new BusinessException("Procedimento já registrado.", 406);
        }

        $dados = [
            'nome' => $nome,
            'valor' => 00.00
        ];

        $procedimento_criado = $this->procedimentoRepository->create($dados);

        $valor = $this->servicoService->getValue($procedimento_criado->id, $servicos);

        $dados = [
            'valor' => $valor,
            'comissao' => ($valor * TipoComissao::PADRAO)
        ];

        $this->procedimentoRepository->update($dados, $procedimento_criado->id);
        
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


