<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

class PetsTableLazyPlaceholderDisabled extends PetsTable
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setLazyPlaceholderDisabled();
    }
}
