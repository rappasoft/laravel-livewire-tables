<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ReorderingHelpers
{
    public function getReorderMethod(): string
    {
        return $this->reorderMethod;
    }

    public function getReorderStatus(): bool
    {
        return $this->reorderStatus;
    }

    #[Computed]
    public function showReorderButton(): bool
    {
        return $this->getReorderStatus() === true;
    }

    #[Computed]
    public function reorderIsEnabled(): bool
    {
        return $this->getReorderStatus() === true;
    }

    public function reorderIsDisabled(): bool
    {
        return $this->getReorderStatus() === false;
    }

    #[Computed]
    public function getCurrentlyReorderingStatus(): bool
    {
        return $this->currentlyReorderingStatus;
    }

    public function currentlyReorderingIsEnabled(): bool
    {
        return $this->getCurrentlyReorderingStatus() === true;
    }

    public function currentlyReorderingIsDisabled(): bool
    {
        return $this->getCurrentlyReorderingStatus() === false;
    }

    public function getHideReorderColumnUnlessReorderingStatus(): bool
    {
        return $this->hideReorderColumnUnlessReorderingStatus;
    }

    public function hideReorderColumnUnlessReorderingIsEnabled(): bool
    {
        return $this->getHideReorderColumnUnlessReorderingStatus() === true;
    }

    public function hideReorderColumnUnlessReorderingIsDisabled(): bool
    {
        return $this->getHideReorderColumnUnlessReorderingStatus() === false;
    }

    public function getDefaultReorderColumn(): ?string
    {
        return $this->defaultReorderColumn;
    }

    public function getDefaultReorderDirection(): string
    {
        return $this->defaultReorderDirection;
    }

    public function setReorderingSession(): void
    {
        session([$this->getReorderingSessionKey() => true]);
    }

    public function forgetReorderingSession(): void
    {
        session()->forget($this->getReorderingSessionKey());
    }

    public function hasReorderingSession(): bool
    {
        return session()->has($this->getReorderingSessionKey());
    }

    public function getReorderingSessionKey(): string
    {
        return $this->getTableName().'-reordering';
    }

    public function getReorderingBackupSessionKey(): string
    {
        return $this->getTableName().'-reordering-backup';
    }

    public function getReorderColumn(): Column
    {
        return Column::make('reorder')->label(fn () => null);
    }
}
