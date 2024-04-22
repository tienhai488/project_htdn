<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);

    public function getDataForOrderStatistic($startDate, $endDate, $filter, $range);
}
