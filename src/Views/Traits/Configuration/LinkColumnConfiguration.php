<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait LinkColumnConfiguration
{
    // TODO: Test
    public function title(callable $callback): self
    {
        $this->titleCallback = $callback;

        return $this;
    }


}
