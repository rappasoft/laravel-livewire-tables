<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableMount;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class WithMountTest extends TestCase
{
    public function test_mounttable_gets_correct_first_item(): void
    {
        $view = view('livewire-tables::datatable');

        $table = new PetsTableMount();
        $table->boot();
        $table->mount(102);
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

        $this->assertSame(strtoupper($rows->first()->name), 'MAY');
        $this->assertNotSame(strtoupper($rows->first()->name), 'CHICO');
        $this->assertNotSame(strtoupper($rows->first()->name), 'CARTMAN');

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
        $this->assertNotSame(strtoupper($rows2->first()->name), 'MAY');

        $table3 = new PetsTableMount();
        $table3->boot();
        $table3->mount();
        $table3->bootedComponentUtilities();
        $table3->bootedWithData();
        $table3->bootedWithColumns();
        $table3->bootedWithColumnSelect();
        $table3->bootedWithSecondaryHeader();
        $table3->booted();
        $table3->renderingWithData($view, []);
        $table3->renderingWithPagination($view, []);
        $table3->render();
        $rows3 = $table3->getRows();

        $this->assertSame(strtoupper($rows3->first()->name), 'CARTMAN');
        $this->assertNotSame(strtoupper($rows3->first()->name), 'CHICO');
        $this->assertNotSame(strtoupper($rows3->first()->name), 'MAY');

    }
}
