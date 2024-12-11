<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait ActionsStylingConfiguration
{
    public function setActionWrapperAttributes(array $actionWrapperAttributes): self
    {
        $this->actionWrapperAttributes = [...$this->actionWrapperAttributes, ...$actionWrapperAttributes];

        return $this;
    }
}
