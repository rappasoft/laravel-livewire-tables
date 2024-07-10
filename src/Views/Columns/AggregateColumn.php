<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\AggregateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\AggregateColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

class AggregateColumn extends Column
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnConfiguration::sortable insteadof IsColumn; }

    public ?string $dataSource;

    public string $aggregateMethod = 'count';

    public ?string $foreignColumn;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (!isset($this->dataSource))
        {
            throw new DataTableConfigurationException('You must specify a data source');
        }
        else
        {
            return parent::getContents($row);
        }
        
    }

}
