<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Enums;

/**
 * Filter layout enum
 */
enum FilterLayout: string
{
    case Popover = 'popover';
    case Slidedown = 'slide-down';

    /**
     * Check if this is popover layout
     */
    public function isPopover(): bool
    {
        return $this === self::Popover;
    }

    /**
     * Check if this is slidedown layout
     */
    public function isSlidedown(): bool
    {
        return $this === self::Slidedown;
    }
}

