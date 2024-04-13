<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserProfile;
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

    function getDataForDatatable(array $searchArr)
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

    function getUserProfile($model)
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

    function create($data)
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
            ->user_profile
            ->addMediaFromBase64(json_decode($data['thumbnail'])->data)
            ->usingFileName(json_decode($data['thumbnail'])->name)
            ->toMediaCollection(UserProfile::USER_PROFILE_THUMBNAIL_COLLECTION);

        return $user;
    }

    function update($user, $data)
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

        if ($user->user_profile) {
            $userProfile = $user->user_profile;
            $user->user_profile()->update($userProfileData);
        } else {
            $userProfile = $user->user_profile()->create($userProfileData);
        }

        $userProfile->clearMediaCollection(UserProfile::USER_PROFILE_THUMBNAIL_COLLECTION);

        $userProfile
            ->addMediaFromBase64(json_decode($data['thumbnail'])->data)
            ->usingFileName(json_decode($data['thumbnail'])->name)
            ->toMediaCollection(UserProfile::USER_PROFILE_THUMBNAIL_COLLECTION);

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

    function updateProfile($user, $data)
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

        if ($user->user_profile) {
            $userProfile = $user->user_profile;
            $user->user_profile()->update($userProfileData);
        } else {
            $userProfile = $user->user_profile()->create($userProfileData);
        }

        $userProfile->clearMediaCollection(UserProfile::USER_PROFILE_THUMBNAIL_COLLECTION);

        if ($data['filepond']) {
            $userProfile
                ->addMediaFromBase64(json_decode($data['filepond'])->data)
                ->usingFileName(json_decode($data['filepond'])->name)
                ->toMediaCollection(UserProfile::USER_PROFILE_THUMBNAIL_COLLECTION);
        }

        return $user;
    }
}