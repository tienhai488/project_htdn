<?php

namespace App\Repositories\Salary;

use App\Repositories\RepositoryInterface;

interface SalaryRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);

    public function updateSalaryStatus($salary);
}