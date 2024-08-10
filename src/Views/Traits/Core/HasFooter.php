<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasFooter
{
    protected bool $footer = false;

    protected mixed $footerCallback = null;

    /**
     * @param  mixed  $callback
     */
    public function footer($callback = null): self
    {
        $this->footer = true;

        $this->footerCallback = $callback;

        return $this;
    }

    public function footerFilter(string $filterKey): self
    {
        $this->footer = true;

        $this->footerCallback = $filterKey;

        return $this;
    }

    public function hasFooter(): bool
    {
        return $this->footer === true;
    }

    public function hasFooterCallback(): bool
    {
        return $this->footerCallback !== null;
    }

    /**
     * @return mixed
     */
    public function getFooterCallback()
    {
        return $this->footerCallback;
    }

    public function footerCallbackIsString(): bool
    {
        return is_string($this->getFooterCallback());
    }

    public function footerCallbackIsFilter(): bool
    {
        $callback = $this->getFooterCallback();
        return ($callback instanceof Filter);
    }

    /**
     * @param  mixed  $rows
     * @return mixed
     */
    public function getFooterContents($rows)
    {
        $value = null;
        $callback = $this->getFooterCallback();

        if (is_callable($callback)) {
            $value = call_user_func($callback, $rows);

            if ($this->isHtml()) {
                return new HtmlString($value);
            }
            return $value;
        } else {
            throw new DataTableConfigurationException('The footer callback must be a closure, filter object, or filter key if using footerFilter().');
        }

        return null;
    }

    public function getFooterFilter(?Filter $filter, array $filterGenericData)
    {
        if ($filter !== null && $filter instanceof Filter) {
            return $filter->setFilterPosition('footer')->setGenericDisplayData($filterGenericData)->render();
        } else {
            throw new DataTableConfigurationException('The footer callback must be a closure, filter object, or filter key if using footerFilter().');
        }
        return null;
    }

}
