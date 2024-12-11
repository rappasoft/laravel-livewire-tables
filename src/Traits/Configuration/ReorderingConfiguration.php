<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ReorderingConfiguration
{
    public function setReorderStatus(bool $status): self
    {
        $this->reorderStatus = $status;

        return $this;
    }

    public function setReorderEnabled(): self
    {
        $this->setReorderStatus(true);

        return $this;
    }

    public function setReorderDisabled(): self
    {
        $this->setReorderStatus(false);

        return $this;
    }

    public function setCurrentlyReorderingStatus(bool $status): self
    {
        $this->currentlyReorderingStatus = $status;

        return $this;
    }

    public function setCurrentlyReorderingEnabled(): self
    {
        $this->setCurrentlyReorderingStatus(true);

        return $this;
    }

    public function setCurrentlyReorderingDisabled(): self
    {
        $this->setCurrentlyReorderingStatus(false);

        return $this;
    }

    public function setHideReorderColumnUnlessReorderingStatus(bool $status): self
    {
        $this->hideReorderColumnUnlessReorderingStatus = $status;

        return $this;
    }

    public function setHideReorderColumnUnlessReorderingEnabled(): self
    {
        $this->setHideReorderColumnUnlessReorderingStatus(true);

        return $this;
    }

    public function setHideReorderColumnUnlessReorderingDisabled(): self
    {
        $this->setHideReorderColumnUnlessReorderingStatus(false);

        return $this;
    }

    public function setReorderMethod(string $method): self
    {
        $this->reorderMethod = $method;

        return $this;
    }

    public function setDefaultReorderSort(string $field, string $direction = 'asc'): self
    {
        $this->defaultReorderColumn = $field;
        $this->defaultReorderDirection = $direction;

        return $this;
    }
}
