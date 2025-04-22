<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

use Illuminate\Support\Str;

trait LivewireComponentColumnConfiguration
{

    /**
     * Defines which component to use
     *
     * @param string $livewireComponent
     * @return self
     */
    public function component(string $livewireComponent): self
    {
        $this->livewireComponent = (Str::startsWith($livewireComponent, 'livewire:')) ? substr($livewireComponent, 9) : $livewireComponent;

        return $this;
    }
}
