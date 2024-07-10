<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait AggregateColumnHelpers
{
    public function getDataSource(): string
    {

        return $this->dataSource;
    }

    public function hasDataSource(): bool
    {
        return isset($this->dataSource);
    }

    public function getAggregateMethod(): string
    {
        return $this->aggregateMethod;
    }

    public function hasForeignColumn(): bool
    {
        return isset($this->foreignColumn);
    }

    public function getForeignColumn(): string
    {
        return $this->foreignColumn;
    }

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! isset($this->dataSource)) {
            throw new DataTableConfigurationException('You must specify a data source');
        } else {
            return parent::getContents($row);
        }
    }
}
