<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);

    function getUserProfile($model);
}