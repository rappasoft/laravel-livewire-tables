<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;

trait ThemeHelpers
{
    public function getTheme(): string
    {
        return $this->theme ?? config('livewire-tables.theme', 'tailwind');
    }

    #[Computed]
    public function isTailwind(): bool
    {
        return $this->getTheme() === 'tailwind';
    }

    #[Computed]
    public function isBootstrap(): bool
    {
        return $this->getTheme() === 'bootstrap-4' || $this->getTheme() === 'bootstrap-5';
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
