<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Enums;

/**
 * Pagination method enum
 */
enum PaginationMethod: string
{
    case Standard = 'standard';
    case Simple = 'simple';
    case Cursor = 'cursor';

    /**
     * Check if this is standard pagination
     */
    public function isStandard(): bool
    {
        return $this === self::Standard;
    }

    /**
     * Check if this is simple pagination
     */
    public function isSimple(): bool
    {
        return $this === self::Simple;
    }

    /**
     * Check if this is cursor pagination
     */
    public function isCursor(): bool
    {
        return $this === self::Cursor;
    }
}

