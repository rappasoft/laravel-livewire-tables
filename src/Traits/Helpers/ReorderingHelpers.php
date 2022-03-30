<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait ReorderingHelpers
{
    /**
     * @return string
     */
    public function getReorderMethod(): string
    {
        return $this->reorderMethod;
    }

    /**
     * @return bool
     */
    public function getReorderStatus(): bool
    {
        return $this->reorderStatus;
    }

    /**
     * @return bool
     */
    public function reorderIsEnabled(): bool
    {
        return $this->getReorderStatus() === true;
    }

    /**
     * @return bool
     */
    public function reorderIsDisabled(): bool
    {
        return $this->getReorderStatus() === false;
    }

    /**
     * @return bool
     */
    public function getCurrentlyReorderingStatus(): bool
    {
        return $this->currentlyReorderingStatus;
    }

    /**
     * @return bool
     */
    public function currentlyReorderingIsEnabled(): bool
    {
        return $this->getCurrentlyReorderingStatus() === true;
    }

    /**
     * @return bool
     */
    public function currentlyReorderingIsDisabled(): bool
    {
        return $this->getCurrentlyReorderingStatus() === false;
    }

    /**
     * @return bool
     */
    public function getHideReorderColumnUnlessReorderingStatus(): bool
    {
        return $this->hideReorderColumnUnlessReorderingStatus;
    }

    /**
     * @return bool
     */
    public function hideReorderColumnUnlessReorderingIsEnabled(): bool
    {
        return $this->getHideReorderColumnUnlessReorderingStatus() === true;
    }

    /**
     * @return bool
     */
    public function hideReorderColumnUnlessReorderingIsDisabled(): bool
    {
        return $this->getHideReorderColumnUnlessReorderingStatus() === false;
    }

    /**
     * @return string|null
     */
    public function getDefaultReorderColumn(): ?string
    {
        return $this->defaultReorderColumn;
    }

    /**
     * @return string
     */
    public function getDefaultReorderDirection(): string
    {
        return $this->defaultReorderDirection;
    }

    /**
     *
     */
    public function setReorderingSession(): void
    {
        session([$this->getReorderingSessionKey() => true]);
    }

    /**
     *
     */
    public function forgetReorderingSession(): void
    {
        session()->forget($this->getReorderingSessionKey());
    }

    /**
     * @return bool
     */
    public function hasReorderingSession(): bool
    {
        return session()->has($this->getReorderingSessionKey());
    }

    /**
     * @return string
     */
    public function getReorderingSessionKey(): string
    {
        return $this->getTableName().'-reordering';
    }

    /**
     * @return string
     */
    public function getReorderingBackupSessionKey(): string
    {
        return $this->getTableName().'-reordering-backup';
    }
}
