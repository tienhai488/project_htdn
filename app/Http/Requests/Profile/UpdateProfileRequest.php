<?php

namespace App\Http\Requests\Profile;

use App\Enums\Gender;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => [
                'required',
                'max:100',
            ],
            'email' => [
                'required',
                'max:255',
                'email:rfc,dns',
                'unique:users,email,' . auth()->id(),
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
            'email' => 'Trường :attribute không đúng định dạng.',
            'unique' => 'Trường :attribute đã tồn tại trong CSDL.',
            'exists' => 'Trường :attribute không tồn tại.',
            'date' => 'Trường :attribute không phải là định dạng của ngày-tháng.',
            'before' => 'Trường :attribute phải đủ 18 tuổi.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'tên',
            'email' => 'email',
            'phone_number' => 'số điện thoại',
            'gender' => 'giới tính',
            'citizen_id' => 'CMND/CCCD',
            'birthday' => 'ngày sinh',
            'address' => 'địa chỉ',
        ];
    }
}