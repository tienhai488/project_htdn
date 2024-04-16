<?php

namespace App\Repositories\PurchaseOrder;

use App\Repositories\RepositoryInterface;

interface PurchaseOrderRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);
}
