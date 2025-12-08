<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Enums;

/**
 * Summary calculation type enum
 */
enum SummaryType: string
{
    case Sum = 'sum';
    case Avg = 'avg';
    case Count = 'count';
    case Min = 'min';
    case Max = 'max';
    case Callback = 'callback';

    /**
     * Check if this requires a callback
     */
    public function requiresCallback(): bool
    {
        return $this === self::Callback;
    }

    /**
     * Get display label
     */
    public function label(): string
    {
        return match ($this) {
            self::Sum => 'Sum',
            self::Avg => 'Average',
            self::Count => 'Count',
            self::Min => 'Minimum',
            self::Max => 'Maximum',
            self::Callback => 'Custom',
        };
    }
}

