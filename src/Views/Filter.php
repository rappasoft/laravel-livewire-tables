<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsFilter;

abstract class Filter
{
    use IsFilter;

    public function __construct(string $name, string $key = null)
    {
        $this->name = $name;

        if ($key) {
            $this->key = $key;
        } else {
            $this->key = Str::snake($name);
        }
        $this->config([]);
    }

    /**
     * @return static
     */
    public static function make(string $name, string $key = null): Filter
    {
        return new static($name, $key);
    }

    abstract public function isEmpty(string $value): bool;

    abstract public function render(): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory;
}
