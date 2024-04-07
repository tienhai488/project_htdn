<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case UNPAID = 0;
    case PAID = 1;

    public static function getPaymentStatuses(): array
    {
        return [
            [
                'case' => self::UNPAID,
                'description' => self::UNPAID->getDescription(),
            ],
            [
                'case' => self::PAID,
                'description' => self::PAID->getDescription(),
            ]
        ];
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::UNPAID => 'Chưa thanh toán',
            self::PAID => 'Đã thanh toán',
        };
    }

    public function getTypeButton(): string
    {
        return match ($this) {
            self::UNPAID => 'danger',
            self::PAID => 'primary',
        };
    }
}