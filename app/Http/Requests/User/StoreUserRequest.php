<?php

namespace App\Http\Requests\User;

use App\Acl\Acl;
use App\Enums\Gender;
use App\Enums\UserStatus;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermission(Acl::PERMISSION_USER_ADD_HR);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thumbnail' => [
                'required',
            ],
            'name' => [
                'required',
                'max:100',
            ],
            'email' => [
                'required',
                'max:255',
                'email:rfc,dns',
                'unique:users',
            ],
            'status' => [
                'required',
                Rule::enum(UserStatus::class),
            ],
            'roles' => [
                'required',
            ],
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'confirmed',
            ],
            'department_id' => [
                'required',
                'exists:departments,id',
            ],
            'phone_number' => [
                'required',
                'max:20',
                new PhoneNumber,
            ],
            'gender' => [
                'required',
                Rule::enum(Gender::class),
            ],
            'citizen_id' => [
                'required',
                'numeric',
                'max:50',
                'unique:user_profiles',
            ],
            'birthday' => [
                'required',
                'date',
                'before:-18 years',
            ],
            'address' => [
                'required',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'max' => 'Trường :attribute tối đa :max kí tự.',
            'min' => 'Trường :attribute ít nhất :min kí tự.',
            'email' => 'Trường :attribute không đúng định dạng.',
            'unique' => 'Trường :attribute đã tồn tại.',
            'exists' => 'Trường :attribute không tồn tại.',
            'confirmed' => 'Giá trị xác nhận trong trường :attribute không khớp.',
            'date' => 'Trường :attribute không phải là định dạng của ngày-tháng.',
            'before' => 'Trường :attribute phải đủ 18 tuổi.',
            'numeric' => 'Trường :attribute phải là số.',
        ];
    }

    public function attributes(): array
    {
        return [
            'thumbnail' => 'ảnh đại diện',
            'name' => 'tên',
            'email' => 'email',
            'status' => 'trạng thái tài khoản',
            'roles' => 'vai trò tài khoản',
            'password' => 'mật khẩu',
            'department_id' => 'phòng ban',
            'phone_number' => 'số điện thoại',
            'gender' => 'giới tính',
            'citizen_id' => 'CMND/CCCD',
            'birthday' => 'ngày sinh',
            'address' => 'địa chỉ',
        ];
    }
}
