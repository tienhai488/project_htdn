<?php

namespace App\Http\Requests\Candidate;

use App\Acl\Acl;
use App\Enums\CandidateStatus;
use App\Enums\Gender;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermission(Acl::PERMISSION_CANDIDATE_ADD_HR);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'recruitment_id' => [
                'required',
                'exists:recruitments,id',
            ],
            'name' => [
                'required',
                'max:100',
            ],
            'email' => [
                'required',
                'max:255',
                'email:rfc,dns',
            ],
            'phone_number' => [
                'required',
                'max:20',
                new PhoneNumber,
            ],
            'birthday' => [
                'required',
                'date',
                'before:-18 years',
            ],
            'gender' => [
                'required',
                Rule::enum(Gender::class),
            ],
            'desired_salary' => [
                'required',
                'numeric',
                'min:1',
            ],
            'status' => [
                'required',
                Rule::enum(CandidateStatus::class),
            ],
            'cv' => [
                'required',
            ],
            'note' => [
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
            'min' => 'Trường :attribute ít nhất :min kí tự.',
            'email' => 'Trường :attribute không đúng định dạng.',
            'unique' => 'Trường :attribute đã tồn tại.',
            'exists' => 'Trường :attribute không tồn tại.',
            'confirmed' => 'Giá trị xác nhận trong trường :attribute không khớp.',
            'date' => 'Trường :attribute không phải là định dạng của ngày-tháng.',
            'before' => 'Trường :attribute phải đủ 18 tuổi.',
            'numeric' => 'Trường :attribute phải là số.',
        ];
    }

    public function attributes(): array
    {
        return [
            'recruitment_id' => 'đợt tuyển dụng',
            'name' => 'tên',
            'email' => 'email',
            'phone_number' => 'số điện thoại',
            'birthday' => 'ngày sinh',
            'gender' => 'giới tính',
            'desired_salary' => 'mức lương mong muốn',
            'status' => 'trạng thái ứng viên',
            'cv' => 'CV',
            'note' => 'ghi chú',
        ];
    }
}
