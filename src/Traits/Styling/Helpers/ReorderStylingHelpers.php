<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait ReorderStylingHelpers
{
    /**
     * Used to get attributes for the <th> for Bulk Actions
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getReorderThAttributes(): array
    {
        return $this->reorderThAttributes ?? ['default' => true];
    }

    #[Computed]
    public function hasReorderThAttributes(): bool
    {
        return $this->getReorderThAttributes() != ['default' => true];
    }
}
