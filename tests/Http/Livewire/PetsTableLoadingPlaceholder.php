<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

class PetsTableLoadingPlaceholder extends PetsTable
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setLoadingPlaceholderEnabled()
            ->setLoadingPlaceholderContent('TestLoadingPlaceholderContentTestTest');
    }
}
