<?php

namespace App\Repositories\User;

use App\Models\Supplier;
use App\Repositories\BaseRepository;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Supplier $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
