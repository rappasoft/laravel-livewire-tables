<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait CollapsingColumnsStylingHelpers
{
    /**
     * Retrieves attributes for the Collapsed Column Collapse Button
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getCollapsingColumnButtonCollapseAttributes(): array
    {
        return [...['default-styling' => true, 'default-colors' => true], ...$this->collapsingColumnButtonCollapseAttributes];
    }

    /**
     * Retrieves attributes for the Collapsed Column Expand Button
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getCollapsingColumnButtonExpandAttributes(): array
    {
        return [...['default-styling' => true, 'default-colors' => true], ...$this->collapsingColumnButtonExpandAttributes];
    }
}
