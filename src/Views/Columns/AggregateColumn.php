<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\AggregateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\AggregateColumnHelpers;

class AggregateColumn extends Column
{
    use AggregateColumnConfiguration,
        AggregateColumnHelpers;

    public ?string $dataSource;

    public string $aggregateMethod = 'count';

    public ?string $foreignColumn;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
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
