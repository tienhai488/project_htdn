<?php

namespace App\Http\Requests\Order;

use App\Enums\DeliveryStatus;
use App\Enums\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
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
            'customer_id' => [
                'required',
                'exists:customers,id',
            ],
            'shipping_unit_id' => [
                'required',
                'exists:shipping_units,id',
            ],
            'payment_status' => [
                'required',
                Rule::enum(PaymentStatus::class),
            ],
            'delivery_status' => [
                'required',
                Rule::enum(DeliveryStatus::class),
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
            'enum' => 'Trường :attribute đã chọn không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'customer_id' => 'khách hàng',
            'shipping_unit_id' => 'đơn vị vận chuyển',
            'payment_status' => 'trạng thái thanh toán',
            'delivery_status' => 'trạng thái giao hàng',
            'note' => 'ghi chú',
        ];
    }
}