<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait CollapsingColumnConfiguration
{
    public function setCollapsingColumnsStatus(bool $status): self
    {
        $this->collapsingColumnsStatus = $status;

        return $this;
    }

    public function setCollapsingColumnsEnabled(): self
    {
        $this->setCollapsingColumnsStatus(true);

        return $this;
    }

    public function setCollapsingColumnsDisabled(): self
    {
        $this->setCollapsingColumnsStatus(false);

        return $this;
    }
}
