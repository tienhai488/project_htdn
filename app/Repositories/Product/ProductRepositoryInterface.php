<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);

    public function getProductListForOrder();

    public function getDataForPurchaseOrderStatistic();
}
