<?php

namespace App\Models\Repositories;

use App\Models\Entities\Servico;

class ServicoRepository extends BaseRepository
{
    public function __construct(Servico $model)
    {
        $this->model = $model;
    }
}