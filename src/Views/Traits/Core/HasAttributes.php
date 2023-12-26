<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasAttributes
{
    protected ?Closure $attributesCallback = null;

    public function attributes(Closure $callback): self
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
        return new ComponentAttributeBag($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
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

            return $key.'="'.$attributes[$key].'"';
        }, array_keys($attributes)));
    }
}
