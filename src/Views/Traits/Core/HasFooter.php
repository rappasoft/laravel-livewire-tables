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

    /**
     * @param  mixed  $rows
     * @return mixed
     */
    public function getFooterContents($rows, array $filterGenericData)
    {
        $value = null;
        $callback = $this->getFooterCallback();

        if ($this->hasFooterCallback()) {
            if (is_callable($callback)) {
                $value = call_user_func($callback, $rows);

                if ($this->isHtml()) {
                    return new HtmlString($value);
                }
            } elseif ($callback instanceof Filter) {
                return $callback->setFilterPosition('footer')->setGenericDisplayData($filterGenericData)->render();
            } elseif (is_string($callback)) {
                $filter = $this->getComponent()->getFilterByKey($callback);

                if ($filter instanceof Filter) {
                    return $filter->setFilterPosition('footer')->setGenericDisplayData($filterGenericData)->render();
                }
            } else {
                throw new DataTableConfigurationException('The footer callback must be a closure, filter object, or filter key if using footerFilter().');
            }
        }

        return $value;
    }
}
