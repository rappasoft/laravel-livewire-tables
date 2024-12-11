<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait ActionsStylingHelpers
{
    #[Computed]
    public function getActionWrapperAttributes(): array
    {
        return [...['class' => '', 'default-styling' => true, 'default-colors' => true], ...$this->actionWrapperAttributes];
    }
}
