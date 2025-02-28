<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

use Livewire\Attributes\{On,Renderless};

trait HandlesUpdateStatusForExternalFilter
{
    public bool $skipUpdate = false;

    protected bool $needsUpdating = false;
}
