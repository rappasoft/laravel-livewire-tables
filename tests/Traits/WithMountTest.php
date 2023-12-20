<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableMount;

class WithMountTest extends TestCase
{
    /** @test */
    public function mounttable_gets_correct_first_item(): void
    {
        $view = view('livewire-tables::datatable');

        $table = new PetsTableMount();
        $table->boot();
        $table->mount(4);
        $table->bootedComponentUtilities();
        $table->bootedWithData();
        $table->bootedWithColumns();
        $table->bootedWithColumnSelect();
        $table->bootedWithSecondaryHeader();
        $table->booted();
        $table->renderingWithData($view, []);
        $table->renderingWithPagination($view, []);
        $table->render();
        $rows = $table->getRows();

        $this->assertSame(strtoupper($rows->first()->name), 'CARTMAN');
        $this->assertNotSame(strtoupper($rows->first()->name), 'CHICO');

        $table2 = new PetsTableMount();
        $table2->boot();
        $table2->mount(202);
        $table2->bootedComponentUtilities();
        $table2->bootedWithData();
        $table2->bootedWithColumns();
        $table2->bootedWithColumnSelect();
        $table2->bootedWithSecondaryHeader();
        $table2->booted();
        $table2->renderingWithData($view, []);
        $table2->renderingWithPagination($view, []);
        $table2->render();
        $rows2 = $table2->getRows();
        $this->assertSame(strtoupper($rows2->first()->name), 'CHICO');
        $this->assertNotSame(strtoupper($rows2->first()->name), 'CARTMAN');
    

    }

}
