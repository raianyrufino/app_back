<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\Services\ProcedimentoService;
use App\Http\Requests\Procedimento\RegistrarRequest;

class ProcedimentoController extends Controller
{
    public function __construct(ProcedimentoService $procedimentoService)
    {
        $this->procedimentoService = $procedimentoService;
    }

    public function register(RegistrarRequest $request)
    {
       return $this->procedimentoService->register( 
                                    $request->nome,
                                    $request->servicos
                                );
    }   

    public function getAll()
    {
        return $this->procedimentoService->getAll();
    }

    public function getById($id)
    {
        return $this->procedimentoService->getById($id);
    }
}
