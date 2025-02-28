<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait HasFooterStyling
{
    protected ?Closure $footerTrAttributesCallback;

    protected ?Closure $footerTdAttributesCallback;

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getFooterTrAttributes($rows): array
    {
        return isset($this->footerTrAttributesCallback) ? call_user_func($this->footerTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getFooterTdAttributes(Column $column, $rows, int $index): array
    {
        return isset($this->footerTdAttributesCallback) ? call_user_func($this->footerTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }

    public function setFooterTrAttributes(Closure $callback): self
    {
        $this->footerTrAttributesCallback = $callback;

        return $this;
    }

    public function setFooterTdAttributes(Closure $callback): self
    {
        $this->footerTdAttributesCallback = $callback;

        return $this;
    }
}
