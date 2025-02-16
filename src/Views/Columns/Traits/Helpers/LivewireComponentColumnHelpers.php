<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

trait LivewireComponentColumnHelpers
{
    /**
     * Retrieves the defined Component View
     */
    public function getLivewireComponent(): ?string
    {
        return $this->livewireComponent ?? null;
    }

    /**
     * Determines whether a Component View has been set
     */
    public function hasLivewireComponent(): bool
    {
        return isset($this->livewireComponent);
    }
}
