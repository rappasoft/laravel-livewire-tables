<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ImageColumnConfiguration
{
    // TODO: Test
    public function location(callable $callback): self
    {
        $this->locationCallback = $callback;

        return $this;
    }

    public function attributes(callable $callback): self
    {
        $this->attributesCallback = $callback;

        return $this;
    }
}
