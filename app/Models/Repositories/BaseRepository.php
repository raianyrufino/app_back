<?php

namespace App\Models\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function create($data)
    {
        return $this->model->create($data);   
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findBy($field, $value)
    {   
        return $this->model->where($field, $value)->first();
    }

    public function update($data, $id)
    {   
        return $this->model->whereId($id)->update($data);
    }

    public function getAllWithPagination($value)
    {
        return $this->model->paginate($value);
    }
}