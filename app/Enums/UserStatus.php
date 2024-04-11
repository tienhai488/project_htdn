<?php

namespace App\Enums;

enum UserStatus: int
{
    case NOT_ACTIVATED = 0;
    case ACTIVATED = 1;
    case LOCKED = 2;

    public function isNotActivated(): bool
    {
        return $this == self::NOT_ACTIVATED;
    }

    public function isActivated(): bool
    {
        return $this == self::ACTIVATED;
    }

    public function isLocked(): bool
    {
        return $this == self::LOCKED;
    }

    public static function getUserStatuses(): array
    {
        return array_map(fn ($case) => [
            'case' => $case,
            'description' => $case->getDescription(),
        ], self::cases());
    }

    public function getDescription()
    {
        return match ($this) {
            self::NOT_ACTIVATED => 'Chưa kích hoạt',
            self::ACTIVATED => 'Kích hoạt',
            self::LOCKED => 'Khóa tài khoản',
        };
    }

    public function getButtonType(): string
    {
        return match ($this) {
            self::NOT_ACTIVATED => 'warning',
            self::ACTIVATED => 'primary',
            self::LOCKED => 'danger',
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
