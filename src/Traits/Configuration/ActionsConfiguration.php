<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ActionsConfiguration
{
    public function setActionWrapperAttributes(array $actionWrapperAttributes): self
    {
        $this->actionWrapperAttributes = [...['default-styling' => true, 'default-colors' => true], ...$actionWrapperAttributes];

        return $this;
    }

    public function setActionsInToolbar(): self
    {
        $this->displayActionsInToolbar = true;

        return $this;
    }

    public function setActionsPosition(string $position): self
    {
        $this->actionsPosition = $position;
    }

    public function setActionsLeft(): self
    {
        $this->actionsPosition = 'left';
    }

    public function setActionsCenter(): self
    {
        $this->actionsPosition = 'center';
    }

    public function setActionsRight(): self
    {
        $this->actionsPosition = 'right';
    }
}
