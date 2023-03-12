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
     * Get the filter slide down row.
     *
     * @return string
     */
    public function getFilterSlidedownRow(): string
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
     * @return string
     */
    public function getFilterSlidedownColspan(): string
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
     * @return mixed
     */
    public function getDefaultValue()
    {
        return null;
    }

    /**
     * Get the filter instance.
     *
     * @return \Rappasoft\LaravelLivewireTables\Views\Filter
     */
    public function filter(callable $callback): Filter
    {
        $this->filterCallback = $callback;

        return $this;
    }

    /**
     * Determine if the filter has a callback.
     *
     * @return bool
     */
    public function hasFilterCallback(): bool
    {
        return $this->filterCallback !== null;
    }

    /**
     * Get the filter callback.
     *
     * @return callable
     */
    public function getFilterCallback(): callable
    {
        return $this->filterCallback;
    }

    /**
     * Get the filter custom filter pill title.
     *
     * @return string|null
     */
    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    /**
     * Get the filter title.
     *
     * @return string
     */
    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }

    /**
     * Get the filter options.
     *
     * @return string|null
     */
    public function getFilterPillValue($value): ?string
    {
        return $value;
    }

    /**
     * Get the filter options.
     *
     * @return array<mixed>
     */
    public function getCustomFilterPillValues(): array
    {
        return $this->filterPillValues;
    }

    /**
     * Get the filter custom filter pill.
     *
     * @return string|null
     */
    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }

    /**
     * Get whether the filter has configurations defined.
     *
     * @return bool
     */
    public function hasConfigs(): bool
    {
        return count($this->getConfigs()) > 0;
    }

    /**
     * Get whether the filter has a specific configuration.
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
}
