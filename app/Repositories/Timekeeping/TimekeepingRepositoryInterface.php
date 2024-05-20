<?php

namespace App\Repositories\Timekeeping;

use App\Repositories\RepositoryInterface;

interface TimekeepingRepositoryInterface extends RepositoryInterface
{
    public function getDataTimekeepingForUser($user, $data);

    public function updateTimekeepingForUser($user, $data);
}
