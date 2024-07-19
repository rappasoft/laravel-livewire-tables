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
     */
    public function setCollapsingColumnButtonCollapseAttributes(array $collapsingColumnButtonCollapseAttributes): self
    {
        $this->collapsingColumnButtonCollapseAttributes = [...$this->collapsingColumnButtonCollapseAttributes, ...$collapsingColumnButtonCollapseAttributes];

        return $this;
    }
    /**
     * Used to set attributes for the Collapsed Column Expand Button
     */
    public function setCollapsingColumnButtonExpandAttributes(array $collapsingColumnButtonExpandAttributes): self
    {
        $this->collapsingColumnButtonExpandAttributes = [...$this->collapsingColumnButtonExpandAttributes, ...$collapsingColumnButtonExpandAttributes];

        return $this;
    }

}
