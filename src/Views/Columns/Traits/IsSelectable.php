<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait IsSelectable
{
    protected bool $selectable = true;

    protected bool $selected = true;

    public function isSelectable(): bool
    {
        return $this->selectable === true;
    }

    public function isSelected(): bool
    {
        return $this->selected === true;
    }

    public function excludeFromColumnSelect(): self
    {
        $this->selectable = false;

        return $this;
    }

    public function deselected(): self
    {
        $this->selected = false;

        return $this;
    }

    public function selectedIf(callable|bool $value): self
    {
        if (is_bool($value)) {
            $this->selected = $value;
        } else {
            $this->selected = call_user_func($value);
        }

        return $this;
    }

    public function deselectedIf(callable|bool $value): self
    {
        if (is_bool($value)) {
            $this->selected = ! $value;
        } else {
            $this->selected = ! call_user_func($value);
        }

        return $this;
    }
}
