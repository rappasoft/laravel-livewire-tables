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
     * Get the filter configs.
     *
     * @return array<mixed>
     */
    public function getConfigs(): array
    {
        return $this->config;
    }

    /**
     * Get a single filter config.
     *
     * @return mixed
     */
    public function getConfig(string $key)
    {
        return $this->config[$key] ?? null;
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
    public function getDefaultValue()
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

    public function hasConfigs(): bool
    {
        return count($this->getConfigs()) > 0;
    }

    public function hasConfig(string $key): bool
    {
        return array_key_exists($key, $this->getConfigs()) && $this->getConfig($key) !== null;
    }

    public function isHiddenFromMenus(): bool
    {
        return $this->hiddenFromMenus === true;
    }

    public function isVisibleInMenus(): bool
    {
        return $this->hiddenFromMenus === false;
    }

    public function isHiddenFromPills(): bool
    {
        return $this->hiddenFromPills === true;
    }

    public function isVisibleInPills(): bool
    {
        return $this->hiddenFromPills === false;
    }

    public function isHiddenFromFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === true;
    }

    public function isVisibleInFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === false;
    }

    public function isResetByClearButton(): bool
    {
        return $this->resetByClearButton === true;
    }

    /**
     * Determines whether this filter instance is in the secondary header/footer
     */
    public function hasCustomPosition(): bool
    {
        return ! is_null($this->filterPosition);
    }

    /**
     * Returns the custom position of the footer (header or footer)
     */
    public function getCustomPosition(): string
    {
        return $this->filterPosition;
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
     * Get the filter slide down row.
     */
    public function getFilterSlidedownRow(): ?int
    {
        return $this->filterSlidedownRow;
    }

    /**
     * Get whether the filter has a configured slide down row.
     */
    public function hasFilterSlidedownRow(): bool
    {
        return ! is_null($this->filterSlidedownRow);
    }

    /**
     * Get the filter slide down col span.
     */
    public function getFilterSlidedownColspan(): ?int
    {
        return $this->filterSlidedownColspan;
    }

    /**
     * Get whether the filter has a configured slide down colspan.
     */
    public function hasFilterSlidedownColspan(): bool
    {
        return ! is_null($this->filterSlidedownColspan);
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
}
