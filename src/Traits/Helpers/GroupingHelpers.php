<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\On;

trait GroupingHelpers
{
    public function groupingIsEnabled(): bool
    {
        return $this->groupingStatus === true;
    }

    public function groupingIsDisabled(): bool
    {
        return $this->groupingStatus === false;
    }

    public function getGroupByColumn(): ?string
    {
        return $this->groupByColumn;
    }

    public function groupsAreCollapsed(): bool
    {
        return $this->groupsCollapsed === true;
    }

    public function groupsAreExpanded(): bool
    {
        return $this->groupsCollapsed === false;
    }

    public function isGroupExpanded(string $groupKey): bool
    {
        if ($this->groupsAreExpanded()) {
            return true;
        }

        return in_array($groupKey, $this->expandedGroups, true);
    }

    #[On('toggleGroup')]
    #[On('toggle-group')]
    public function toggleGroup(string $groupKey): void
    {
        if ($this->isGroupExpanded($groupKey)) {
            $this->expandedGroups = array_values(array_diff($this->expandedGroups, [$groupKey]));
        } else {
            $this->expandedGroups[] = $groupKey;
        }
    }

    /**
     * Group rows by the specified column
     */
    public function getGroupedRows(Collection $rows): Collection
    {
        if (! $this->groupingIsEnabled() || ! $this->getGroupByColumn()) {
            return $rows;
        }

        $column = $this->getColumnBySelectName($this->getGroupByColumn());
        if (! $column) {
            return $rows;
        }

        return $rows->groupBy(function ($row) use ($column) {
            return $column->getContents($row);
        });
    }
}

