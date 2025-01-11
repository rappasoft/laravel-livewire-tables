<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Illuminate\Support\Str;

trait LivewireComponentColumnConfiguration
{
    public function component(string $livewireComponent): self
    {
        $this->livewireComponent = (Str::startsWith($livewireComponent, 'livewire:')) ? substr($livewireComponent, 9) : $livewireComponent;

        return $this;
    }
}
