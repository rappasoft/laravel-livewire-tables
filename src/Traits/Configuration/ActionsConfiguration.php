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

    public function setActionsPosition(string $position): self
    {
        $this->actionsPosition = $position;

        return $this;
    }

    public function setActionsLeft(): self
    {
        $this->actionsPosition = 'left';

        return $this;
    }

    public function setActionsCenter(): self
    {
        $this->actionsPosition = 'center';

        return $this;
    }

    public function setActionsRight(): self
    {
        $this->actionsPosition = 'right';

        return $this;
    }
}
