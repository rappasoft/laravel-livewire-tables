<?php

namespace Rappasoft\LivewireTables\Http\Livewire\Traits;

/**
 * Trait Sorting
 *
 * @package Rappasoft\LivewireTables\Http\Livewire\Traits
 */
trait Sorting
{

    /**
     * Sorting
     */

    /**
     * The initial field to be sorting by
     *
     * @var string
     */
    public $sortField = 'id';

    /**
     * The initial direction to sort
     *
     * @var bool
     */
    public $sortDirection = 'asc';

    /**
     * @param $attribute
     */
    public function sort($attribute) : void
    {
        if ($this->sortField !== $attribute) {
            $this->sortDirection = 'asc';
        } else {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }

        $this->sortField = $attribute;
    }
}
