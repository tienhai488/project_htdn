<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->orderByDesc('created_at')->get();
    }

    public function paginate($perPage = 20)
    {
        return $this->model->orderBy('created_at')->paginate($perPage);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($model, $data)
    {
        $model->update($data);

        return $model;
    }

    public function destroy($model)
    {
        return $model->delete();
    }
}
