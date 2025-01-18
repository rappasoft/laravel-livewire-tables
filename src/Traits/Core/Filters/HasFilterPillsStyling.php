<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

use Livewire\Attributes\{Computed, Locked};
use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\FilterPillsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\FilterPillsStylingHelpers;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait HasFilterPillsStyling
{
    use FilterPillsStylingConfiguration,
        FilterPillsStylingHelpers;

    #[Locked]
    public bool $filterPillsStatus = true;

    protected array $filterPillsItemAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $filterPillsResetFilterButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $filterPillsResetAllButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    public function setFilterPillsStatus(bool $status): self
    {
        $this->filterPillsStatus = $status;

        return $this;
    }

    public function setFilterPillsEnabled(): self
    {
        $this->setFilterPillsStatus(true);

        return $this;
    }

    public function setFilterPillsDisabled(): self
    {
        $this->setFilterPillsStatus(false);

        return $this;
    }

    #[Computed]
    public function showFilterPillsSection(): bool
    {
        return $this->filtersAreEnabled() && $this->filterPillsAreEnabled() && $this->hasAppliedVisibleFiltersForPills();
    }

    public function getFilterPillsStatus(): bool
    {
        return $this->filterPillsStatus;
    }

    public function filterPillsAreEnabled(): bool
    {
        return $this->getFilterPillsStatus() === true;
    }

    public function filterPillsAreDisabled(): bool
    {
        return $this->getFilterPillsStatus() === false;
    }

    public function hasAppliedVisibleFiltersForPills(): bool
    {
        return collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromPills())
            ->count() > 0;
    }
}
