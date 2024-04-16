<?php

namespace App\Repositories\ShippingUnit;

use App\Repositories\RepositoryInterface;

interface ShippingUnitRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);
}
