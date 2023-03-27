<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterHelpers
{
    /**
     * Get the filter name.
     *
     * @param  string  $name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the filter key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Get the filter configs.
     *
     * @return array
     */
    public function getConfigs(): array
    {
        return $this->config;
    }

    /**
     * Get a single filter config.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getConfig(string $key)
    {
        return $this->config[$key] ?? null;
    }

    /**
     * Get the filter keys.
     *
     * @return array
     */
    public function getKeys(): array
    {
        return [];
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function getDefaultValue()
    {
        return null;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function filter(callable $callback): Filter
    {
        $this->filterCallback = $callback;

        return $this;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function hasFilterCallback(): bool
    {
        return $this->filterCallback !== null;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function getFilterCallback(): callable
    {
        return $this->filterCallback;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function getFilterPillValue($value): ?string
    {
        return $value;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function getCustomFilterPillValues(): array
    {
        return $this->filterPillValues;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function hasConfigs(): bool
    {
        return count($this->getConfigs()) > 0;
    }

    /**
     * Get the filter options.
     *
     * @return array
     */
    public function hasConfig(string $key): bool
    {
        return array_key_exists($key, $this->getConfigs()) && $this->getConfig($key) !== null;
    }

    /**
     * @return bool
     */
    public function isHiddenFromMenus(): bool
    {
        return $this->hiddenFromMenus === true;
    }

    /**
     * @return bool
     */
    public function isVisibleInMenus(): bool
    {
        return $this->hiddenFromMenus === false;
    }

    /**
     * @return bool
     */
    public function isHiddenFromPills(): bool
    {
        return $this->hiddenFromPills === true;
    }

    /**
     * @return bool
     */
    public function isVisibleInPills(): bool
    {
        return $this->hiddenFromPills === false;
    }

    /**
     * @return bool
     */
    public function isHiddenFromFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === true;
    }

    /**
     * @return bool
     */
    public function isVisibleInFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === false;
    }

    /**
     * @return bool
     */
    public function isResetByClearButton(): bool
    {
        return $this->resetByClearButton === true;
    }

    public function hasCustomFilterLabel(): bool
    {
        return ! is_null($this->filterCustomLabel);
    }

    public function getCustomFilterLabel(): string
    {
        return $this->filterCustomLabel ?? '';
    }

    /**
     * @return bool
     */
    public function hasCustomPosition(): bool
    {
        return ! is_null($this->filterPosition);
    }

    /**
     * @return string
     */
    public function getCustomPosition(): string
    {
        return $this->filterPosition;
    }
     
     public function hasCustomFilterLabel(): bool
     {
         return ! is_null($this->filterCustomLabel);
     }

    public function getCustomFilterLabel(): string
    {
        return $this->filterCustomLabel ?? '';
    }

    /**
     * Get the filter slide down row.
     *
     * @return int|null
     */
    public function getFilterSlidedownRow(): ?int
    {
        return $this->filterSlidedownRow;
    }

    /**
     * Get whether the filter has a configured slide down row.
     *
     * @return bool
     */
    public function hasFilterSlidedownRow(): bool
    {
        return (! is_null($this->filterSlidedownRow));
    }

    /**
     * Get the filter slide down col span.
     *
     * @return int|null
     */
    public function getFilterSlidedownColspan(): ?int
    {
        return $this->filterSlidedownColspan;
    }

    /**
     * Get whether the filter has a configured slide down colspan.
     *
     * @return bool
     */
    public function hasFilterSlidedownColspan(): bool
    {
        return (! is_null($this->filterSlidedownColspan));
    }
    
    /**
     * Determine if filter has a Custom Pill Blade
     *
     * @return bool
     */
    public function hasCustomPillBlade(): bool
    {
        return $this->filterCustomPillBlade != null;
    }

    /**
     * Get the path to the Custom Pill Blade
     *
     * @return string|null
     */
    public function getCustomPillBlade(): ?string
    {
        return $this->filterCustomPillBlade;
    }
}
