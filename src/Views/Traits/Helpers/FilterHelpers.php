<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterHelpers
{
    /**
     * Get the filter name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the filter key.
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Get the filter keys.
     *
     * @return array<mixed>
     */
    public function getKeys(): array
    {
        return [];
    }

    /**
     * Get the filter options.
     */
    public function getDefaultValue(): mixed
    {
        return null;
    }

    public function filter(callable $callback): Filter
    {
        $this->filterCallback = $callback;

        return $this;
    }

    public function hasFilterCallback(): bool
    {
        return $this->filterCallback !== null;
    }

    public function getFilterCallback(): callable
    {
        return $this->filterCallback;
    }

    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }

    /**
     * @param  mixed  $value
     */
    public function getFilterPillValue($value): ?string
    {
        return $value;
    }

    /**
     * @return array<mixed>
     */
    public function getCustomFilterPillValues(): array
    {
        return $this->filterPillValues;
    }

    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }

    public function isResetByClearButton(): bool
    {
        return $this->resetByClearButton === true;
    }

    /**
     * Returns whether the filter has a custom label blade
     */
    public function hasCustomFilterLabel(): bool
    {
        return ! is_null($this->filterCustomLabel);
    }

    /**
     * Returns the path to the custom filter label blade
     */
    public function getCustomFilterLabel(): string
    {
        return $this->filterCustomLabel ?? '';
    }

    /**
     * Determine if filter has a Custom Pill Blade
     */
    public function hasCustomPillBlade(): bool
    {
        return $this->filterCustomPillBlade != null;
    }

    /**
     * Get the path to the Custom Pill Blade
     */
    public function getCustomPillBlade(): ?string
    {
        return $this->filterCustomPillBlade;
    }

    /**
     * Determines if the Filter has a Default Value via the Component
     */
    public function hasFilterDefaultValue(): bool
    {
        return ! is_null($this->filterDefaultValue);
    }

    public function getFilterLabelAttributes(): array
    {
        return [...['default' => true], ...$this->filterLabelAttributes];
    }

    public function hasFilterLabelAttributes(): bool
    {
        return $this->getFilterLabelAttributes() != ['default' => true] && $this->getFilterLabelAttributes() != ['default' => false];
    }

    public function generateWireKey(string $tableName, string $filterType, string $extraData = ''): string
    {
        return $tableName.'-filter-'.$filterType.'-'.$this->getKey().($extraData != '' ? '-'.$extraData : '').($this->hasCustomPosition() ? '-'.$this->getCustomPosition() : '');
    }

    public function getGenericDisplayData(): array
    {
        return $this->genericDisplayData;
    }

    public function getFilterDisplayData(): array
    {
        return array_merge($this->getGenericDisplayData(), ['filter' => $this]);
    }

    public function render(): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory
    {
        return view($this->getViewPath(), $this->getFilterDisplayData());
    }
}
