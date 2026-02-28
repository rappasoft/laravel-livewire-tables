<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

class PetsTableLazyPlaceholderCustomView extends PetsTable
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setLazyPlaceholderEnabled()
            ->setLazyPlaceholderView('livewire-tables-test::test');
    }
}
