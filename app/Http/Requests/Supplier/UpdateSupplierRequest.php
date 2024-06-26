<?php

namespace App\Http\Requests\Supplier;

use App\Acl\Acl;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermission(Acl::PERMISSION_SUPPLIER_EDIT_WAREHOUSE);
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
                'unique:suppliers,name,' . $this->supplier->id,
            ],
            'phone_number' => [
                'required',
                'max:20',
                new PhoneNumber
            ],
            'email' => [
                'required',
                'max:255',
                'email:rfc,dns',
                'unique:suppliers,email,' . $this->supplier->id,
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
            'unique' => 'Trường :attribute đã tồn tại.',
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