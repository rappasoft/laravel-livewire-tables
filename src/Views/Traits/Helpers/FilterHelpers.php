<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterHelpers
{
    /**
     * Get the filter name.
     *
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
     * @return array<mixed>
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
     * @return array<mixed>
     */
    public function getKeys(): array
    {
        return [];
    }

    /**
     * Get the filter options.
     *
     */
    public function getDefaultValue()
    {
        return null;
    }

    /**
     * @param callable $callback
     *
     * @return Filter
     */
    public function filter(callable $callback): Filter
    {
        $this->filterCallback = $callback;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasFilterCallback(): bool
    {
        return $this->filterCallback !== null;
    }

    /**
     * @return callable
     */
    public function getFilterCallback(): callable
    {
        return $this->filterCallback;
    }

    /**
     * @return string|null
     */
    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    /**
     * @return string
     */
    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }

    /**
     * @param mixed $value
     *
     * @return string|null
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

    /**
     * @param string $value
     *
     * @return string|null
     */
    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }

    /**
     * @return bool
     */
    public function hasConfigs(): bool
    {
        return count($this->getConfigs()) > 0;
    }

    /**
     * @param string $key
     *
     * @return bool
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

    /**
     * Determines whether this filter instance is in the secondary header/footer
     *
     * @return bool
     */
    public function hasCustomPosition(): bool
    {
        return ! is_null($this->filterPosition);
    }

    /**
     * Returns the custom position of the footer (header or footer)
     *
     * @return string
     */
    public function getCustomPosition(): string
    {
        return $this->filterPosition;
    }
     
     /**
      * Returns whether the filter has a custom label blade
      *
      * @return bool
      */
     public function hasCustomFilterLabel(): bool
     {
         return ! is_null($this->filterCustomLabel);
     }

    /**
     * Returns the path to the custom filter label blade
     *
     * @return string
     */
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
