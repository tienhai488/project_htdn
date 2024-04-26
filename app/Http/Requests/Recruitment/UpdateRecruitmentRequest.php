<?php

namespace App\Http\Requests\Recruitment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecruitmentRequest extends FormRequest
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
            'title' => [
                'required',
                'max:100',
                'unique:recruitments,title,' . $this->recruitment->id,
            ],
            'department_id' => [
                'required',
                'exists:departments,id',
            ],
            'position_id' => [
                'required',
                'exists:positions,id',
            ],
            'quantity' => [
                'required',
                'min:1',
                'numeric',
            ],
            'expired_time' => [
                'required',
            ],
            'minimum_salary' => [
                'required',
                'min:1',
                'numeric',
            ],
            'maximum_salary' => [
                'required',
                'min:1',
                'numeric',
            ],
            'description' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'max' => 'Trường :attribute tối đa :max kí tự.',
            'min' => 'Trường :attribute có giá trị tối thiếu là :min.',
            'exists' => 'Trường :attribute không tồn tại.',
            'numeric' => 'Trường :attribute phải là số.',
            'unique' => 'Trường :attribute đã tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'tiêu đề',
            'department_id' => 'phòng ban cần tuyển',
            'position_id' => 'vị trí cần tuyển',
            'quantity' => 'số lượng cần tuyển',
            'expired_time' => 'thời gian kết thúc',
            'minimum_salary' => 'mức lương tối thiểu',
            'maximum_salary' => 'mức lương tối đa',
            'description' => 'mô tả',
        ];
    }
}
