<?php

namespace App\Repositories\PurchaseOrder;

use App\Repositories\RepositoryInterface;

interface PurchaseOrderRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);

    public function getDataForPurchaseOrderStatistic(string $product_category_id, string $startDate, string $endDate);
}
