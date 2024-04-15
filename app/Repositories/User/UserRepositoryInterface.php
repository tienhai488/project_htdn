<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    function getDataForDatatable(array $searchArr);

    function getUserProfile($model);

    function getAllUserWithSalaries($searchParams);

    function getCountUsersInPosition();

    function updateProfile($user, $data);

    function udpatePassword($user, $password);
}
