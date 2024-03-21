<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function find($id);

    public function all();

    public function paginate($perPage = 15);

    public function create($data);

    public function update($model, $data);

    public function destroy($model);
}
