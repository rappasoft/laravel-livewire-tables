<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait BladeManagementConfiguration
{

    public function setCustomBladeOfflinePath(string $offlineBladePath): self
    {
        $this->offlineBladePath = $offlineBladePath;
        
        return $this;

    }
<<<<<<< HEAD
    
    public function setCustomBladeDebugPath(string $debugBladePath): self
=======

    public function setCustomBladeDebugPath(string $debugBladePath)
>>>>>>> 20b71f6d2b3166cc1ecacf4b34ce0c661b70c5b1
    {
        $this->debugBladePath = $debugBladePath;

        return $this;
    }
}
