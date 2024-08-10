<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasSecondaryHeader
{
    protected bool $secondaryHeader = false;

    protected mixed $secondaryHeaderCallback = null;

    /**
     * @param  mixed  $callback
     */
    public function secondaryHeader($callback = null): self
    {
        $this->secondaryHeader = true;

        $this->secondaryHeaderCallback = $callback;

        return $this;
    }

    public function secondaryHeaderFilter(string $filterKey): self
    {
        $this->secondaryHeader = true;

        $this->secondaryHeaderCallback = $filterKey;

        return $this;
    }

    public function hasSecondaryHeader(): bool
    {
        return $this->secondaryHeader === true;
    }

    public function hasSecondaryHeaderCallback(): bool
    {
        return $this->secondaryHeaderCallback !== null;
    }

    /**
     * @return mixed
     */
    public function getSecondaryHeaderCallback()
    {
        return $this->secondaryHeaderCallback;
    }

    public function secondaryHeaderCallbackIsString(): bool
    {
        return is_string($this->getSecondaryHeaderCallback());
    }

    public function secondaryHeaderCallbackIsFilter(): bool
    {
        $callback = $this->getSecondaryHeaderCallback();
        return ($callback instanceof Filter);
    }

    /**
     * @param  mixed  $rows
     * @return mixed
     */
    public function getSecondaryHeaderContents($rows)
    {
        $value = null;
        $callback = $this->getSecondaryHeaderCallback();

        if (is_callable($callback)) {
            $value = call_user_func($callback, $rows);
            if ($this->isHtml()) {
                return new HtmlString($value);
            }
            return $value;
        } else {
            throw new DataTableConfigurationException('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().');
        }
        return null;
    }


    public function getSecondaryHeaderFilter(?Filter $filter, array $filterGenericData)
    {
        if ($filter !== null && $filter instanceof Filter) {
            return $filter->setFilterPosition('header')->setGenericDisplayData($filterGenericData)->render();
        }  else {
            throw new DataTableConfigurationException('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().');
        }
        return null;
    }

}
