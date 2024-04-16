<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case UNPAID = 0;
    case PAID = 1;

    public static function getPaymentStatuses(): array
    {
        return array_map(fn ($case) => [
            'case' => $case,
            'description' => $case->getDescription(),
        ], self::cases());
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::UNPAID => 'Chưa thanh toán',
            self::PAID => 'Đã thanh toán',
        };
    }

    public function getButtonType(): string
    {
        return match ($this) {
            self::UNPAID => 'danger',
            self::PAID => 'primary',
        };
    }

    public function getStatus()
    {
        return [
            'value' => $this,
            'description' => $this->getDescription(),
            'button_type' => $this->getButtonType(),
        ];
    }
}
