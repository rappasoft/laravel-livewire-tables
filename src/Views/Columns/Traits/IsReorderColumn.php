<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait IsReorderColumn
{
    protected bool $isReorderColumn = false;

    public function isReorderColumn(): bool
    {
        return $this->isReorderColumn;
    }

    public function getIsReorderColumn(): bool
    {
        return $this->isReorderColumn;
    }

    public function setIsReorderColumn(bool $isReorderColumn): self
    {
        $this->isReorderColumn = $isReorderColumn;

        return $this;
    }
}
