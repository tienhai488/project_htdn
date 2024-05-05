<?php

namespace App\Enums;

enum WorkingStatus: int
{
    case WORK = 0;
    case DAYOFF = 1;
    case WEEKEND = 2;

    public static function getWorkingStatuses(): array
    {
        return array_map(fn ($case) => [
            'case' => $case,
            'description' => $case->getDescription(),
            'isShowOT' => $case->isShowOT(),
        ], self::cases());
    }

    public function getDescription()
    {
        return match ($this) {
            self::WORK => 'Đi làm',
            self::DAYOFF => 'Nghỉ làm',
            self::WEEKEND => 'Nghỉ T7, CN',
        };
    }

    public function isShowOT()
    {
        return match ($this) {
            self::WORK => true,
            self::DAYOFF => false,
            self::WEEKEND => false,
        };
    }
}