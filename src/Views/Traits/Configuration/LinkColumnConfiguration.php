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
