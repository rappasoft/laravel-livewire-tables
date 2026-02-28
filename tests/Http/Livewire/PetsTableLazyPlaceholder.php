<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

class PetsTableLazyPlaceholder extends PetsTable
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setLazyPlaceholderEnabled();
    }
}
