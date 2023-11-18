<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait BladeManagementHelpers
{
    public function getCustomBladeOfflinePath(): string
    {
        return $this->offlineBladePath ?? 'livewire-tables::includes.offline';
    }

    public function getCustomBladeDebugPath(): string
    {
        return $this->debugBladePath ?? 'livewire-tables::includes.debug';
    }
}
