<?php

namespace App\Repositories\Department;

use App\Repositories\RepositoryInterface;

interface DepartmentRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);
}