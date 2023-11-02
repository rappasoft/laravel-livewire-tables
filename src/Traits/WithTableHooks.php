<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use function Livewire\wrap;

trait WithTableHooks
{
    public function callHook($name, $params = [])
    {
        if (method_exists($this, $name)) {
            wrap($this)->__call($name, $params);
        }
    }

    public function callTraitHook($name, $params = [])
    {
        foreach (class_uses_recursive($this) as $trait) {
            $method = $name.class_basename($trait);

            if (method_exists($this, $method)) {
                wrap($this)->$method(...$params);
            }
        }
    }
}
