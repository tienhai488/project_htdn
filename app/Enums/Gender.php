<?php

namespace App\Enums;

enum Gender: int
{
    case FEMALE = 0;
    case MALE = 1;

    public static function getGenders(): array
    {
        return array_map(fn ($case) => [
            'case' => $case,
            'description' => $case->getDescription(),
        ], self::cases());
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::FEMALE => 'Nữ',
            self::MALE => 'Nam',
        };
    }
}
