<?php

namespace App\Models\Repositories;

use App\Models\Entities\Procedimento;

class ProcedimentoRepository extends BaseRepository
{
    public function __construct(Procedimento $model)
    {
        $this->model = $model;
    }

    public function getWithServicos()
    {
        return $this->model->with('servicos')->paginate(10);
    }

    public function getWithServicosById($id)
    {
        return $this->model->where('id', $id)->with('servicos')->first();
    }
}