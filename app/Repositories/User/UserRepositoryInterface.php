<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getDataForDatatable(array $searchArr);

    public function getDataForSalaryDatatable(array $searchArr);

    public function getDataForTimekeepingDatatable(array $searchArr);

    public function getUserProfile($model);

    public function getAllUserWithSalaries($searchParams);

    public function getCountUsersInPosition();

    public function updateProfile($user, $data);

    public function udpatePassword($user, $password);

    public function getAllApprovedSalaryUser(User $user);
}
