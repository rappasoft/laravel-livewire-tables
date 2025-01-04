<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Exception;
use Illuminate\View\ViewException;
use Livewire\Component;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\{BrokenSecondaryHeaderTable, NoBuildMethodTable, NoPrimaryKeyTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable,PetsTableAttributes};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class DataTableComponentVisualsTest extends TestCase
{
    public function test_primary_key_has_to_be_set(): void
    {
        $this->expectException(\Illuminate\View\ViewException::class);
        Livewire::test(NoPrimaryKeyTable::class)
            ->call('setSearch', 'abcd');
    }
}
