<?php

namespace App\Http\Requests\PurchaseOrder;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermission(Acl::PERMISSION_PURCHASE_ORDER_ADD_WAREHOUSE);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],
            'note' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'exists' => 'Trường :attribute không tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'supplier_id' => 'tên',
            'note' => 'ghi chú',
        ];
    }
}