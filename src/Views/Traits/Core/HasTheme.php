<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Livewire\Attributes\{Computed, Locked};

trait HasTheme
{
    #[Locked]
    public ?string $theme;

    public function getTheme(): string
    {
        return $this->theme ?? ($this->theme = config('livewire-tables.theme', 'tailwind'));
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        if (($theme === 'bootstrap-4' || $theme === 'bootstrap-5') && method_exists($this, 'setPaginationTheme')) {
            $this->setPaginationTheme('bootstrap');
        }

        return $this;
    }

    #[Computed]
    public function isTailwind(): bool
    {
        return ! $this->isBootstrap4() && ! $this->isBootstrap5();
    }

    #[Computed]
    public function isBootstrap(): bool
    {
        return $this->isBootstrap4() || $this->isBootstrap5();
    }

    #[Computed]
    public function isBootstrap4(): bool
    {
        return $this->getTheme() === 'bootstrap-4';
    }

    #[Computed]
    public function isBootstrap5(): bool
    {
        return $this->getTheme() === 'bootstrap-5';
    }
}
