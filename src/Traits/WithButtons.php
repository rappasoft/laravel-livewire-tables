<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Trait WithButtons.
 */
trait WithButtons
{
    public bool $showButtons = true;

    public function getButtonsProperty(): array
    {
        return $this->buttons();
    }

    public function buttons(): array
    {
        if (property_exists($this, 'buttons')) {
            return $this->buttons;
        }

        return [];
    }
}
