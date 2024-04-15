<?php

namespace App\Repositories\Position;

use App\Repositories\RepositoryInterface;

interface PositionRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);
}
