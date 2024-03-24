<?php

namespace App\Repositories\Supplier;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SupplierRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);
}