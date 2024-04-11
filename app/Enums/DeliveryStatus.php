<?php

namespace App\Enums;

enum DeliveryStatus: int
{
    case PENDING = 0;
    case APPROVED = 1;
    case PREPARING = 2;
    case DELIVERING = 3;
    case SUCCESS = 4;
    case FAILED = 5;
    case CANCEL = 6;

    public function isPending(): bool
    {
        return $this == self::PENDING;
    }

    public static function getDeliveryStatuses(): array
    {
        return array_map(fn ($case) => [
            'case' => $case,
            'description' => $case->getDescription(),
        ], self::cases());
    }

    public function getDescription()
    {
        return match ($this) {
            self::PENDING => 'Chờ duyệt',
            self::APPROVED => 'Đã duyệt',
            self::PREPARING => 'Chuẩn bị hàng',
            self::DELIVERING => 'Đang giao',
            self::SUCCESS => 'Thành công',
            self::FAILED => 'Thất bại',
            self::CANCEL => 'Đã hủy đơn',
        };
    }
}
