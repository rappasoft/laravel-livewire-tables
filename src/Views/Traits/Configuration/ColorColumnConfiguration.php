<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ColorColumnConfiguration
{
    public function color(callable $callback): self
    {
        $this->colorCallback = $callback;

        return $this;
    }

    public function attributes(callable $callback): self
    {
        $this->attributesCallback = $callback;

        return $this;
    }

    public function defaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }
}
