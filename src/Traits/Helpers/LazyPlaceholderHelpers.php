<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait LazyPlaceholderHelpers
{
    public function getLazyPlaceholderEnabled(): bool
    {
        return $this->lazyPlaceholderEnabled;
    }

    public function hasLazyPlaceholderEnabled(): bool
    {
        return $this->getLazyPlaceholderEnabled();
    }

    public function hasLazyPlaceholderView(): bool
    {
        return ! is_null($this->getLazyPlaceholderView());
    }

    public function getLazyPlaceholderView(): ?string
    {
        return $this->lazyPlaceholderView;
    }
}
