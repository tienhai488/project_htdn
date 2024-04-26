<?php

namespace App\Repositories\Recruitment;

use App\Repositories\RepositoryInterface;

interface RecruitmentRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);
}
