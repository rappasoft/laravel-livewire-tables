<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;

trait SummariesHelpers
{
    public function getSummariesStatus(): bool
    {
        return $this->summariesStatus;
    }

    public function summariesAreEnabled(): bool
    {
        return $this->getSummariesStatus() === true;
    }

    public function summariesAreDisabled(): bool
    {
        return $this->getSummariesStatus() === false;
    }

    public function hasSummaries(): bool
    {
        return $this->summariesAreEnabled() && ! empty($this->summaryColumns);
    }

    /**
     * @return Collection
     */
    public function getSummaryColumns(): Collection
    {
        return collect($this->summaryColumns);
    }

    /**
     * Calculate summary for a column
     */
    public function calculateSummary($column, Collection $rows)
    {
        if (! $column->hasSummary()) {
            return null;
        }

        // Use the column's own calculateSummary method
        return $column->calculateSummary($rows);
    }
}

