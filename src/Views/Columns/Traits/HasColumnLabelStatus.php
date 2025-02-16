<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait HasColumnLabelStatus
{
    protected bool $displayColumnLabel = true;

    public function getColumnLabelStatus(): bool
    {
        return $this->displayColumnLabel ?? true;
    }

    public function setColumnLabelStatus(bool $status): self
    {
        $this->displayColumnLabel = $status;

        return $this;
    }

    public function setColumnLabelStatusEnabled(): self
    {
        return $this->setColumnLabelStatus(true);
    }

    public function setColumnLabelStatusDisabled(): self
    {
        return $this->setColumnLabelStatus(false);
    }
}
