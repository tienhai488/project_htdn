<?php

namespace App\Repositories\Salary;

use App\Repositories\RepositoryInterface;

interface SalaryRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);

    function updateSalaryStatus($salary);
}
