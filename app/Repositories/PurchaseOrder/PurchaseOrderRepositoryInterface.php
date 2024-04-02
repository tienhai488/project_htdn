<?php

namespace App\Repositories\PurchaseOrder;

use App\Repositories\RepositoryInterface;

interface PurchaseOrderRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);
}