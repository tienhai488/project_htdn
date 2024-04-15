<?php

namespace App\Http\Requests\User;

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
        return true;
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
                'max:50',
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
            'unique' => 'Trường :attribute đã tồn tại trong CSDL.',
            'exists' => 'Trường :attribute không tồn tại.',
            'confirmed' => 'Giá trị xác nhận trong trường :attribute không khớp.',
            'date' => 'Trường :attribute không phải là định dạng của ngày-tháng.',
            'before' => 'Trường :attribute phải đủ 18 tuổi.',
        ];
    }

    public function attributes(): array
    {
        return [
            'thumbnail' => 'ảnh đại diện',
            'name' => 'tên',
            'email' => 'email',
            'status' => 'trạng thái tài khoản',
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