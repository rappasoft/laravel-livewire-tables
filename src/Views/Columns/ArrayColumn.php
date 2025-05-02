<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\ArrayColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\ArrayColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\IsColumn;

class ArrayColumn extends Column
{
    use IsColumn,
        ArrayColumnConfiguration,
        ArrayColumnHelpers;

    public string $separator = '<br />';

    public string $emptyValue = '';

    protected mixed $dataCallback = null;

    protected mixed $outputFormat = null;

    public ?string $outputWrapperStart = null;

    public ?string $outputWrapperEnd = null;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $outputValues = [];
        $value = $this->getValue($row);

        if (! $this->hasDataCallback()) {
            throw new DataTableConfigurationException('You must set a data() method on an ArrayColumn');
        }

        if (! $this->hasOutputFormatCallback()) {
            throw new DataTableConfigurationException('You must set an outputFormat() method on an ArrayColumn');
        }

        foreach (call_user_func($this->getDataCallback(), $value, $row) as $i => $v) {
            $outputValues[] = call_user_func($this->getOutputFormatCallback(), $i, $v);
        }

        $returnedValue = (! empty($outputValues) ? implode($this->getSeparator(), $outputValues) : $this->getEmptyValue());

        if ($this->hasOutputWrapperStart() && $this->hasOutputWrapperEnd()) {
            $returnedValue = $this->getOutputWrapperStart().$returnedValue.$this->getOutputWrapperEnd();
        }

        return new HtmlString($returnedValue);
    }
}
