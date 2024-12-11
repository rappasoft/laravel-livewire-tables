<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait CollapsingColumnsStylingConfiguration
{
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
}
