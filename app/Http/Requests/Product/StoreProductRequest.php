<?php

namespace App\Http\Requests\Product;

use App\Rules\CheckFileUploadFileMultiple;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
                'unique:products',
            ],
            'category_id' => [
                'required',
                'exists:product_categories,id',
            ],
            'description' => [
                'required',
            ],
            'thumbnail' => [
                'required',
            ],
            'images.*' => [
                'required',
                new CheckFileUploadFileMultiple,
            ],
            'regular_price' => [
                'required',
                'min:1',
                'numeric',
            ],
            'sale_price' => [
                'required',
                'min:1',
                'numeric',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'max' => 'Trường :attribute tối đa :max kí tự.',
            'exists' => 'Trường :attribute không tồn tại.',
            'min' => 'Trường :attribute có giá trị tối thiếu là :min.',
            'numeric' => 'Trường :attribute phải là số.',
            'unique' => 'Trường :attribute đã tồn tại trong CSDL.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'tên',
            'category_id' => 'danh mục',
            'description' => 'mô tả',
            'thumbnail' => 'ảnh đại diện',
            'images.*' => 'hình ảnh liên quan',
            'regular_price' => 'giá nhập',
            'sale_price' => 'giá bán',
        ];
    }
}