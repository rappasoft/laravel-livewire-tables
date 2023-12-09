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

    public function getCustomEmptyClasses(): array
    {
        return $this->customEmptyClasses ?? ['view' => '', 'row' => 'livewire-tables-empty-row', 'col' => '', 'div' => '', 'span' => ''];
    }

    public function getCustomEmptyViewClasses(): string
    {
        return $this->customEmptyViewClasses ?? '';
    }
}
