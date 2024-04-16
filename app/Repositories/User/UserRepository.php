<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function getDataForDatatable(array $searchArr)
    {
        $query = $this->model->query();

        $keyword = Arr::get($searchArr, 'search', '');

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }

            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        return $query->orderByDesc('created_at')->paginate(self::PER_PAGE);
    }

    public function getUserProfile($model)
    {
        return $model->user_profile
            ?:
            [
                'user_id' => $model->id,
                'department_id' => '',
                'phone_number' => '',
                'gender' => '',
                'citizen_id' => '',
                'birthday' => '',
                'address' => '',
            ];
    }

    public function create($data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'password' => Hash::make($data['password']),
        ];

        $user = $this->model->create($userData);

        $userProfileData = [
            'department_id' => $data['department_id'],
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'citizen_id' => $data['citizen_id'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
        ];

        $user->user_profile()->create($userProfileData);

        $user
            ->addMediaFromBase64(json_decode($data['thumbnail'])->data)
            ->usingFileName(json_decode($data['thumbnail'])->name)
            ->toMediaCollection(User::USER_THUMBNAIL_COLLECTION);

        return $user;
    }

    public function update($user, $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
        ];

        if (!empty($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }

        $user->update($userData);

        $userProfileData = [
            'department_id' => $data['department_id'],
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'citizen_id' => $data['citizen_id'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
        ];

        $user->user_profile ?
            $user->user_profile()->update($userProfileData)
            :
            $user->user_profile()->create($userProfileData);

        $user->clearMediaCollection(User::USER_THUMBNAIL_COLLECTION);

        $user
            ->addMediaFromBase64(json_decode($data['thumbnail'])->data)
            ->usingFileName(json_decode($data['thumbnail'])->name)
            ->toMediaCollection(User::USER_THUMBNAIL_COLLECTION);

        return $user;
    }

    public function getAllUserWithSalaries($searchParams)
    {
        $limit = Arr::get($searchParams, 'limit', self::PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');

        $query = $this->model->query()->with('salaries');

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }

            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        return $query->latest()->paginate($limit);
    }

    public function getCountUsersInPosition()
    {
        $users = $this->model->get();

        return $users->map(function ($product) {
            $approvedSalary = $product->approved_salary;
            return $approvedSalary ? $approvedSalary->position->id : null;
        })
            ->filter()
            ->groupBy(function ($positionId) {
                return $positionId;
            })
            ->map(function ($group) {
                return $group->count();
            });
    }

    public function updateProfile($user, $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        $user->update($userData);

        $userProfileData = [
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'citizen_id' => $data['citizen_id'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
        ];

        $user->user_profile ?
            $user->user_profile()->update($userProfileData)
            :
            $user->user_profile()->create($userProfileData);

        $user->clearMediaCollection(User::USER_THUMBNAIL_COLLECTION);

        if ($data['filepond']) {
            $user
                ->addMediaFromBase64(json_decode($data['filepond'])->data)
                ->usingFileName(json_decode($data['filepond'])->name)
                ->toMediaCollection(User::USER_THUMBNAIL_COLLECTION);
        }

        return $user;
    }

    public function udpatePassword($user, $password)
    {
        return $user->update(
            ['password' => Hash::make($password)]
        );
    }
}