<?php

namespace App\Repositories\Position;

use App\Repositories\RepositoryInterface;

interface PositionRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);
}