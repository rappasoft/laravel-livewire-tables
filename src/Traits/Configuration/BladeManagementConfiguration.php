<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait BladeManagementConfiguration
{
    public function setCustomBladeOfflinePath(string $offlineBladePath)
    {
        $this->offlineBladePath = $offlineBladePath;
    }

    public function setCustomBladeDebugPath(string $debugBladePath)
    {
        $this->debugBladePath = $debugBladePath;
    }
}
