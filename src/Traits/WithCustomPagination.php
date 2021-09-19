<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\WithPagination;

/**
 * Trait WithCustomPagination.
 */
trait WithCustomPagination
{
    use WithPagination;

    public function pageName(): string
    {
        if (property_exists($this, 'pageName')) {
            if (! isset($this->{$this->pageName})) {
                $this->{$this->pageName} = 1;
            }

            return $this->pageName;
        }

        return 'page';
    }
}
