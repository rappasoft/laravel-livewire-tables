<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class WithColumnsTest extends TestCase
{
    public function test_rendering_with_columns_returns_columns(): void
    {

        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->useComputedPropertiesDisabled();

            }
        };

        $view = view('livewire-tables::datatable');

        $testTableDefault->bootAll();
        $view = $testTableDefault->renderAll();

        $this->assertSame(9, $view->getData()['columns']->count());
    }
}
