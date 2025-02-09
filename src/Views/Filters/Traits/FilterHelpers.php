<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

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
        return view($this->getViewPath())
            ->with($this->getFilterDisplayData())
            ->with(['filterInputAttributes' => $this->getInputAttributesBag()]);
    }
}
