<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait CollapsingColumnConfiguration
{
    public function setCollapsingColumnsStatus(bool $status): self
    {
        $this->collapsingColumnsStatus = $status;

        return $this;
    }

    public function setCollapsingColumnsEnabled(): self
    {
        $this->setCollapsingColumnsStatus(true);

        return $this;
    }

    public function setCollapsingColumnsDisabled(): self
    {
        $this->setCollapsingColumnsStatus(false);

        return $this;
    }

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
