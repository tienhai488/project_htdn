<?php

namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
