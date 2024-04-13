<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Repositories\User\UserRepositoryInterface;

class ProfileController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
    }

    public function index()
    {
        $user = auth()->user();
        $userProfile = $this->userRepository->getUserProfile($user);
        $approvedSalary = $user->approved_salary;
        $genders = Gender::getGenders();

        return view(
            'admin.profile.index',
            compact(
                'user',
                'userProfile',
                'approvedSalary',
                'genders',
            )
        );
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->userRepository->updateProfile(auth()->user(), $request->except('_token')) ?
            session()->flash('success', 'Cập nhật thông tin cá nhân thành công')
            :
            session()->flash('error', 'Cập nhật thông tin cá nhân không thành công');

        return back();
    }
}