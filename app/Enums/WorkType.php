<?php

namespace App\Enums;

enum WorkType: int
{
    case NORMAL = 0;
    case WEEKEND = 1;
    case HOLIDAY = 2;

    public static function getWorkTypes(): array
    {
        return array_map(fn ($case) => [
            'case' => $case,
            'description' => $case->getDescription(),
        ], self::cases());
    }

    public function getDescription()
    {
        return match ($this) {
            self::NORMAL => 'Ngày thường',
            self::WEEKEND => 'Ngày nghỉ',
            self::HOLIDAY => 'Ngày lễ',
        };
    }
}