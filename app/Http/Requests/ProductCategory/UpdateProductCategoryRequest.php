<?php

namespace App\Http\Requests\ProductCategory;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermission(Acl::PERMISSION_PRODUCT_CATEGORY_EDIT_WAREHOUSE);
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
                'unique:product_categories,name,' . $this->product_category->id,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'max' => 'Trường :attribute tối đa :max kí tự.',
            'unique' => 'Trường :attribute đã tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'tên',
        ];
    }
}