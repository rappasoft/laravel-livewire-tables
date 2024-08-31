<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasTheme
{
    protected string $theme = 'tailwind';

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): string
    {
        return $this->theme ?? config('livewire-tables.theme', 'tailwind');
    }

    public function isTailwind(): bool
    {
        return $this->getTheme() != 'bootstrap-4' && $this->getTheme() != 'bootstrap-5';
    }

    public function isBootstrap(): bool
    {
        return $this->getTheme() == 'bootstrap-4' || $this->getTheme() == 'bootstrap-5';
    }

    public function isBootstrap4(): bool
    {
        return $this->getTheme() == 'bootstrap-4';
    }

    public function isBootstrap5(): bool
    {
        return $this->getTheme() == 'bootstrap-5';
    }
}
