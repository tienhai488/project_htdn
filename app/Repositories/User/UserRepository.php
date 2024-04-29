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

        $query->with('roles');

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function getDataForSalaryDatatable(array $searchArr)
    {
        $query = $this->model->query();

        $keyword = Arr::get($searchArr, 'search', '');

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }

            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $query->with([
            'salaries',
            'salaries.position',
            'salaries.user',
            'salaries.approvedBy',
        ]);

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function getUserProfile($model)
    {
        return $model->userProfile
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
        $data['password'] = Hash::make($data['password']);

        $user = $this->model->create($data);

        $user->syncRoles(Arr::map($data['roles'], fn ($role) => (int)$role));

        $user->userProfile()->create($data);

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

        $user->syncRoles(Arr::map($data['roles'], fn ($role) => (int)$role));

        $user->userProfile ?
            $user->userProfile()->update($userProfileData)
            :
            $user->userProfile()->create($userProfileData);

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

        $user->userProfile ?
            $user->userProfile()->update($userProfileData)
            :
            $user->userProfile()->create($userProfileData);

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

    public function getAllApprovedSalaryUser(User $user)
    {
        return $user->salaries()->approved()->with([
            'user',
            'approvedBy',
            'position',
        ])->orderByDesc('approved_at')->get();
    }
}
