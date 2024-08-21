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

    public function isTailwind(): bool
    {
        return $this->theme != 'bootstrap-4' && $this->theme != 'bootstrap-5';
    }

    public function isBootstrap(): bool
    {
        return $this->theme == 'bootstrap-4' || $this->theme == 'bootstrap-5';
    }

    public function isBootstrap4(): bool
    {
        return $this->theme == 'bootstrap-4';
    }

    public function isBootstrap5(): bool
    {
        return $this->theme == 'bootstrap-5';
    }
}
