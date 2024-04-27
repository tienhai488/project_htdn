<?php

namespace App\Http\Requests\Salary;

use App\Acl\Acl;
use App\Enums\SalaryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermission(Acl::PERMISSION_SALARY_ADD_HR);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'salary_amount' => [
                'required',
                'numeric',
                'min:1',
            ],
            'salary_position_id' => [
                'required',
                'exists:positions,id',
            ],
            'salary_status' => [
                'required',
                Rule::enum(SalaryStatus::class),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'numeric' => 'Trường :attribute phải là số.',
            'min' => 'Trường :attribute có giá trị tối thiếu là :min.',
            'exists' => 'Trường :attribute không tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'salary_amount' => 'tiền lương',
            'salary_position_id' => 'vị trí',
            'salary_status' => 'trạng thái lương',
        ];
    }
}