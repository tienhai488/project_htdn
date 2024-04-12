<?php

namespace App\Enums;

enum SalaryStatus: int
{
    case PENDING = 0;
    case APPROVED = 1;

    public static function getSalaryStatuses(): array
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
        };
    }
}
