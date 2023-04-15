<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ReorderingConfiguration
{
    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setReorderStatus(bool $status): self
    {
        $this->reorderStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setReorderEnabled(): self
    {
        $this->setReorderStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setReorderDisabled(): self
    {
        $this->setReorderStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setCurrentlyReorderingStatus(bool $status): self
    {
        $this->currentlyReorderingStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setCurrentlyReorderingEnabled(): self
    {
        $this->setCurrentlyReorderingStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setCurrentlyReorderingDisabled(): self
    {
        $this->setCurrentlyReorderingStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingStatus(bool $status): self
    {
        $this->hideReorderColumnUnlessReorderingStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingEnabled(): self
    {
        $this->setHideReorderColumnUnlessReorderingStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingDisabled(): self
    {
        $this->setHideReorderColumnUnlessReorderingStatus(false);

        return $this;
    }

    /**
     * @param  string  $method
     *
     * @return self
     */
    public function setReorderMethod(string $method): self
    {
        $this->reorderMethod = $method;

        return $this;
    }

    /**
     * @param  string  $field
     * @param  string  $direction
     *
     * @return self
     */
    public function setDefaultReorderSort(string $field, string $direction = 'asc'): self
    {
        $this->defaultReorderColumn = $field;
        $this->defaultReorderDirection = $direction;

        return $this;
    }
}
