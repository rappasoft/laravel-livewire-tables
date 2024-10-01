<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ThemedTestCase extends TestCase
{
    protected function setupBasicTableForLivewire()
    {
        return Livewire::test(PetsTable::class);
    }

    public function pagination_shows_by_default()
    {
        return $this->setupBasicTableForLivewire();
    }
}
