<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\Services\ServicoService;
use App\Http\Requests\Servico\RegistrarRequest;

class ServicoController extends Controller
{
    public function __construct(ServicoService $servicoService)
    {
        $this->servicoService = $servicoService;
    }

    public function register(RegistrarRequest $request)
    {
        return $this->servicoService->register(
                                    $request->nome, 
                                    $request->valor
                                );
    }   

    public function getAll()
    {
        return $this->servicoService->getAll();
    }

    public function getAllWithPagination()
    {
        return $this->servicoService->getAllWithPagination();
    }
}
