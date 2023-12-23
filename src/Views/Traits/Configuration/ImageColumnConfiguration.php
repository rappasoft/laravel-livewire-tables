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
}
