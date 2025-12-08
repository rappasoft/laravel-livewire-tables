<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait GroupingConfiguration
{
    /**
     * Enable grouping by a column
     */
    public function groupBy(string $column): self
    {
        $this->groupingStatus = true;
        $this->groupByColumn = $column;

        return $this;
    }

    /**
     * Disable grouping
     */
    public function disableGrouping(): self
    {
        $this->groupingStatus = false;
        $this->groupByColumn = null;
        $this->expandedGroups = [];

        return $this;
    }

    /**
     * Set groups to be collapsed by default
     */
    public function groupsCollapsed(bool $collapsed = true): self
    {
        $this->groupsCollapsed = $collapsed;

        return $this;
    }

    /**
     * Set groups to be expanded by default
     */
    public function groupsExpanded(bool $expanded = true): self
    {
        $this->groupsCollapsed = !$expanded;

        return $this;
    }
}

