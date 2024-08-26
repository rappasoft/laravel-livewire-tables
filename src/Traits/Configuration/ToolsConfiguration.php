<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ToolsConfiguration
{
    public function setToolsStatus(bool $status): self
    {
        $this->toolsStatus = $status;

        return $this;
    }

    public function setToolsEnabled(): self
    {
        return $this->setToolsStatus(true);
    }

    public function setToolsDisabled(): self
    {
        return $this->setToolsStatus(false);
    }

    public function setToolBarStatus(bool $status): self
    {
        $this->toolBarStatus = $status;

        return $this;
    }

    public function setToolBarEnabled(): self
    {
        return $this->setToolBarStatus(true);
    }

    public function setToolBarDisabled(): self
    {
        return $this->setToolBarStatus(false);
    }
}
