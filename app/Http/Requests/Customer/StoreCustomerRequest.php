<?php

namespace App\Http\Requests\Customer;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
                'unique:customers',
            ],
            'phone_number' => [
                'required',
                'max:20',
                new PhoneNumber,
            ],
            'email' => [
                'required',
                'max:255',
                'email:rfc,dns',
                'unique:customers',
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
            'required' => 'Trường :attribute không được để trống!',
            'max' => 'Trường :attribute tối đa :max kí tự!',
            'email' => 'Trường :attribute không đúng định dạng!',
            'unique' => 'Trường :attribute đã tồn tại trong CSDL!',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'tên',
            'phone_number' => 'số điện thoại',
            'email' => 'email',
            'address' => 'địa chỉ',
        ];
    }
}
