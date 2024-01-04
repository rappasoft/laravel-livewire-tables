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

    /**
     * @param  mixed  $rows
     * @return mixed
     */
    public function getSecondaryHeaderContents($rows, array $filterGenericData)
    {
        $value = null;
        $callback = $this->getSecondaryHeaderCallback();

        if ($this->hasSecondaryHeaderCallback()) {
            if (is_callable($callback)) {
                $value = call_user_func($callback, $rows);
                if ($this->isHtml()) {
                    return new HtmlString($value);
                }
            } elseif ($callback instanceof Filter) {
                return $callback->setFilterPosition('header')->setGenericDisplayData($filterGenericData)->render();
            } elseif (is_string($callback)) {
                $filter = $this->getComponent()->getFilterByKey($callback);

                if ($filter instanceof Filter) {
                    return $filter->setFilterPosition('header')->setGenericDisplayData($filterGenericData)->render();
                } else {
                    throw new DataTableConfigurationException('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().');
                }
            } else {
                throw new DataTableConfigurationException('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().');
            }
        }

        return $value;
    }
}
