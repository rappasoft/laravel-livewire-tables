<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Enums;

/**
 * Sort direction enum for column sorting
 */
enum SortDirection: string
{
    case Asc = 'asc';
    case Desc = 'desc';

    /**
     * Get the opposite direction
     */
    public function opposite(): self
    {
        return match ($this) {
            self::Asc => self::Desc,
            self::Desc => self::Asc,
        };
    }

    /**
     * Check if this is ascending
     */
    public function isAsc(): bool
    {
        return $this === self::Asc;
    }

    /**
     * Check if this is descending
     */
    public function isDesc(): bool
    {
        return $this === self::Desc;
    }

    /**
     * Create from string with fallback to Asc
     */
    public static function fromString(string $direction): self
    {
        return match (strtolower($direction)) {
            'desc', 'descending' => self::Desc,
            default => self::Asc,
        };
    }
}

