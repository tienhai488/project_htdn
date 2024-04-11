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
            'position_id' => $data['position_id'],
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
}
