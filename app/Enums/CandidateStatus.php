<?php

namespace App\Enums;

enum CandidateStatus: int
{
    case PENDING = 0;
    case INTERVIEW = 1;
    case ACCEPT = 2;
    case REFUSE = 3;

    public static function getCandidateStatuses(): array
    {
        return array_map(fn ($case) => [
            'case' => $case,
            'description' => $case->getDescription(),
        ], self::cases());
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::PENDING => 'Chờ duyệt ',
            self::INTERVIEW => 'Phỏng vấn',
            self::ACCEPT => 'Chấp nhận',
            self::REFUSE => 'Từ chối',
        };
    }

    public function getButtonType(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::INTERVIEW => 'primary',
            self::ACCEPT => 'success',
            self::REFUSE => 'dark',
        };
    }

    public function getStatus(): array
    {
        return [
            'value' => $this,
            'description' => $this->getDescription(),
            'button_type' => $this->getButtonType(),
        ];
    }

    public function isAllowDelete(): bool
    {
        return match ($this) {
            self::PENDING =>  true,
            self::REFUSE =>  true,
            self::INTERVIEW =>  false,
            self::ACCEPT =>  false,
        };
    }
}
