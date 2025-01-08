<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Columns;

use Livewire\Attributes\Computed;

trait HasCollapsingColumnsStyling
{
    protected array $collapsingColumnButtonCollapseAttributes = ['default-styling' => true, 'default-colors' => true];

    protected array $collapsingColumnButtonExpandAttributes = ['default-styling' => true, 'default-colors' => true];

    /**
     * Used to set attributes for the Collapsed Column Collapse Button
     *
     * @param  array<mixed>  $collapsingColumnButtonCollapseAttributes
     */
    public function setCollapsingColumnButtonCollapseAttributes(array $collapsingColumnButtonCollapseAttributes): self
    {
        $this->collapsingColumnButtonCollapseAttributes = [...['default-colors' => false, 'default-styling' => false], ...$collapsingColumnButtonCollapseAttributes];

        return $this;
    }

    /**
     * Used to set attributes for the Collapsed Column Expand Button
     *
     * @param  array<mixed>  $collapsingColumnButtonExpandAttributes
     */
    public function setCollapsingColumnButtonExpandAttributes(array $collapsingColumnButtonExpandAttributes): self
    {
        $this->collapsingColumnButtonExpandAttributes = [...['default-colors' => false, 'default-styling' => false], ...$collapsingColumnButtonExpandAttributes];

        return $this;
    }

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
