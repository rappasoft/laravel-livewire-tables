<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

trait ButtonGroupColumnHelpers
{
    public function getView(): string
    {
        return $this->view;
    }

    public function getButtons(): array
    {
        return collect($this->buttons)
            ->reject(fn ($button) => ! $button instanceof LinkColumn)
            ->toArray();
    }

    public function getAttributesCallback(): ?callable
    {
        return $this->attributesCallback;
    }

    public function hasAttributesCallback(): bool
    {
        return $this->attributesCallback !== null;
    }
}
