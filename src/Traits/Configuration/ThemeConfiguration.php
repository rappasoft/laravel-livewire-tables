<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ThemeConfiguration
{
    public function setTheme(): void
    {
        $theme = $this->getTheme();

        if ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') {
            $this->setPaginationTheme('bootstrap');
        }
    }
}
