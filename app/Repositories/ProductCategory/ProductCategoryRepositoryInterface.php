<?php

namespace App\Repositories\ProductCategory;

use App\Repositories\RepositoryInterface;

interface ProductCategoryRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);
}