<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordProfileRequest extends FormRequest
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
            'current_password' => [
                'required',
                'current_password',
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
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'min' => 'Trường :attribute ít nhất :min kí tự.',
            'current_password' => 'Trường :attribute không khớp .',
            'confirmed' => 'Giá trị xác nhận trong trường :attribute không khớp.',
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'mật khẩu hiện tại',
            'password' => 'mật khẩu mới',
        ];
    }
}
