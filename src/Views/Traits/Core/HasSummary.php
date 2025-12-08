<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\Support\Collection;

trait HasSummary
{
    protected bool $summary = false;

    protected ?string $summaryType = null;

    protected mixed $summaryCallback = null;

    /**
     * Add a summary to this column
     * 
     * @param string|callable|null $type Type of summary: 'sum', 'avg', 'count', 'min', 'max', or a custom callback
     */
    public function summary(string|callable|null $type = 'sum'): self
    {
        $this->summary = true;

        // Check if it's a Closure or array callback (not just a string that happens to be a PHP function name)
        if ($type instanceof \Closure || (is_array($type) && is_callable($type))) {
            $this->summaryCallback = $type;
            $this->summaryType = 'callback';
        } else {
            $this->summaryType = $type ?? 'sum';
        }

        return $this;
    }

    public function hasSummary(): bool
    {
        return $this->summary === true;
    }

    public function getSummaryType(): ?string
    {
        return $this->summaryType;
    }

    public function hasSummaryCallback(): bool
    {
        return $this->summaryCallback !== null;
    }

    public function getSummaryCallback(): ?callable
    {
        return $this->summaryCallback;
    }

    /**
     * Calculate the summary value for this column
     */
    public function calculateSummary(Collection $rows)
    {
        if (! $this->hasSummary()) {
            return null;
        }

        if ($this->hasSummaryCallback()) {
            return call_user_func($this->summaryCallback, $rows);
        }

        $field = $this->getField();
        if (! $field) {
            return null;
        }

        if ($this->summaryType === 'min') {
            $values = $rows->pluck($field)->filter()->values();
            if ($values->isEmpty()) {
                return null;
            }
            // Convert to array to ensure PHP's min() receives correct type
            $valuesArray = $values->toArray();
            return min($valuesArray);
        }

        if ($this->summaryType === 'max') {
            $values = $rows->pluck($field)->filter()->values();
            if ($values->isEmpty()) {
                return null;
            }
            // Convert to array to ensure PHP's max() receives correct type
            $valuesArray = $values->toArray();
            return max($valuesArray);
        }

        return match ($this->summaryType) {
            'sum' => $rows->sum($field),
            'avg' => round($rows->avg($field), 2),
            'count' => $rows->count(),
            default => null,
        };
    }
}




