<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ActionsConfiguration
{
    public function setActionsInToolbar(bool $status): self
    {
        $this->displayActionsInToolbar = $status;

        return $this;
    }

    public function setActionsInToolbarEnabled(): self
    {
        return $this->setActionsInToolbar(true);
    }

    public function setActionsInToolbarDisabled(): self
    {
        return $this->setActionsInToolbar(false);
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
