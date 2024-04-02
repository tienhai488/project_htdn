<?php

namespace App\Http\Requests\ShippingUnit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingUnitRequest extends FormRequest
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
                'unique:shipping_units,name,' . $this->shipping_unit->id,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống!',
            'max' => 'Trường :attribute tối đa :max kí tự!',
            'unique' => 'Trường :attribute đã tồn tại trong CSDL!',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'tên',
        ];
    }
}
