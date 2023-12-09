<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait EmptyMessageHelpers
{
    public function hasCustomEmptyView(): bool
    {
        return $this->customEmptyView != '';
    }

    public function getCustomEmptyView(): string
    {
        return $this->customEmptyView ?? '';
    }

    public function getCustomEmptyViewClasses(): array
    {
        return $this->customEmptyClasses;
    }
}
