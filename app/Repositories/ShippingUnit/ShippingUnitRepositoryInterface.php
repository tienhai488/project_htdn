<?php

namespace App\Repositories\ShippingUnit;

use App\Repositories\RepositoryInterface;

interface ShippingUnitRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);
}
