<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait CanBeHidden.
 */
trait CanBeHidden
{
    /**
     * @var bool
     */
    protected $hidden = false;

    /**
     * @param $condition
     *
     * @return $this
     */
    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * @return $this
     */
    public function hide(): self
    {
        $this->hidden = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return ! $this->isVisible();
    }
}
