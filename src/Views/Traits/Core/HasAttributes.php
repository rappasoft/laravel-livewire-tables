<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;

trait HasAttributes
{
    protected ?Closure $attributesCallback = null;

    public function attributes(Closure $callback): static
    {
        $this->attributesCallback = $callback;

        return $this;
    }

    public function getAttributesCallback(): ?Closure
    {
        return $this->attributesCallback;
    }

    public function hasAttributesCallback(): bool
    {
        return $this->attributesCallback !== null;
    }

    // TODO: Test
    public function getAttributeBag(Model $row): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row, 'value' => $this->getValue($row)]) : []);
    }

    /**
     * @param  array<mixed>  $attributes
     */
    public function arrayToAttributes(array $attributes): mixed
    {
        return implode(' ', array_map(function ($key) use ($attributes) {
            if (is_bool($attributes[$key])) {
                return $attributes[$key] ? $key : '';
            }

            // Values routinely come from row data; false = leave already-encoded entities alone
            return $key.'="'.e($attributes[$key], false).'"';
        }, array_keys($attributes)));
    }
}
