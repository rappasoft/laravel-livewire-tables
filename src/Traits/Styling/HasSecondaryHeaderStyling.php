<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait HasSecondaryHeaderStyling
{
    protected ?Closure $secondaryHeaderTrAttributesCallback;

    protected ?Closure $secondaryHeaderTdAttributesCallback;

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTrAttributes($rows): array
    {
        return isset($this->secondaryHeaderTrAttributesCallback) ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTdAttributes(Column $column, $rows, int $index): array
    {
        return isset($this->secondaryHeaderTdAttributesCallback) ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }

    public function setSecondaryHeaderTrAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTrAttributesCallback = $callback;

        return $this;
    }

    public function setSecondaryHeaderTdAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTdAttributesCallback = $callback;

        return $this;
    }
}
