<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

trait BooleanColumnConfiguration
{
    public function setSuccessValue(bool $value): self
    {
        $this->successValue = $value;

        return $this;
    }

    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function icons(): self
    {
        $this->type = 'icons';

        return $this;
    }

    public function yesNo(): self
    {
        $this->type = 'yes-no';

        return $this;
    }

    public function toggleable(string $toggleMethod): self
    {
        $this->isToggleable = true;
        $this->toggleMethod = $toggleMethod;

        return $this;
    }
}
