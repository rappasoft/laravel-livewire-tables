<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Livewire\Attributes\On;

class PetsTableEvents extends PetsTable
{
    public function mount()
    {
        $this->setShouldBeHidden();
    }

    #[On('showTable')]
    public function showTable(): void
    {
        $this->setShouldBeDisplayed();
    }

    #[On('hideTable')]
    public function hideTable()
    {
        $this->setShouldBeHidden();
    }
}
