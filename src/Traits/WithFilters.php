<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait WithFilters.
 */
trait WithFilters
{
    /**
     * Filter values
     *
     * @var array
     */
    public array $filters = [];

    /**
     * Map filter names
     *
     * @var array
     */
    public array $filterNames = [];

    /**
     * Default filters
     *
     * @var array|null[]
     */
    public array $baseFilters = [
        'search' => null,
    ];

    /**
     * @var int|null
     */
    public ?int $searchFilterDebounce = null;

    /**
     * @var bool|null
     */
    public ?bool $searchFilterDefer = null;

    /**
     * @var bool|null
     */
    public ?bool $searchFilterLazy = null;

    /**
     * Build Livewire model options for the search input
     *
     * @return string
     */
    public function getSearchFilterOptionsProperty(): string
    {
        if ($this->searchFilterDebounce) {
            return '.debounce.' . $this->searchFilterDebounce . 'ms';
        }

        if ($this->searchFilterDefer) {
            return '.defer';
        }

        if ($this->searchFilterLazy) {
            return '.lazy';
        }

        return '';
    }

    public function resetFilters(): void
    {
        $search = $this->filters['search'] ?? null;
        $this->reset('filters');
        $this->filters['search'] = $search;
    }

    public function updatingFilters(): void
    {
        $this->resetPage();
    }

    public function resetAll(): void
    {
        $this->resetFilters();
        $this->resetSorts();
        $this->resetBulk();
    }

    public function filters(): array
    {
        return [];
    }

    public function cleanFilters(): void
    {
        foreach ($this->filters() as $key => $filter) {
            if (
                $filter->isSelect() &&
                $this->hasFilter($key) &&
                ! in_array($this->getFilter($key), $this->getFilterOptions($key), true)
            ) {
                $this->removeFilter($key);
            }
        }
    }

    public function filtersView(): ?string
    {
        return null;
    }

    public function hasFilter(string $filter): bool
    {
        return isset($this->filters[$filter]) && $this->filters[$filter] !== null;
    }

    public function getFilter(string $filter): ?string
    {
        return $this->filters[$filter] ?? null;
    }

    public function removeFilter($filter): void
    {
        if (isset($this->filters[$filter])) {
            $this->filters[$filter] = null;
        }
    }

    public function getFilterOptions(string $filter): array
    {
        return array_filter(array_keys($this->filters()[$filter]->options() ?? []));
    }
}
