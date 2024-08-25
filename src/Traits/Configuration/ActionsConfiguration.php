<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ActionsConfiguration
{
    public function setActionWrapperAttributes(array $actionWrapperAttributes): self
    {
        $this->actionWrapperAttributes = [...$this->actionWrapperAttributes, ...$actionWrapperAttributes];

        return $this;
    }

    public function setActionsInToolbar(): self
    {
        $this->displayActionsInToolbar = true;

        return $this;
    }

    protected function setActionsPosition(string $position): self
    {
        $this->actionsPosition = ($position == 'left' || $position == 'center' || $position == 'right') ? $position : 'right';

        return $this;
    }

    public function setActionsLeft(): self
    {
        return $this->setActionsPosition('left');
    }

    public function setActionsCenter(): self
    {
        return $this->setActionsPosition('center');
    }

    public function setActionsRight(): self
    {
        return $this->setActionsPosition('right');
    }
}
