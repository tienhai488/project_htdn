<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    const PER_PAGE = 10;

    protected $model;

    public function __construct(Role $model)
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

        $query->with('permissions');

        return $query->latest()->paginate(self::PER_PAGE);
    }

    public function create($data)
    {
        $role = $this->model->create($data);
        $role->givePermissionTo(Arr::map($data['permissions'], fn ($permission) => (int)$permission));
        return $role;
    }

    public function update($role, $data)
    {
        $role->update($data);
        $role->syncPermissions(Arr::map($data['permissions'], fn ($permission) => (int)$permission));
        return $role;
    }

    public function destroy($role)
    {
        if ($role->users()->count()) {
            return [
                'icon' => 'error',
                'title' => 'Xoá vai trò không thành công. Dữ liệu đang tồn tại người dùng.',
            ];
        }

        return $role->delete();
    }
}