<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals\Filters;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

abstract class FilterVisualsTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupBreedsTable();
    }
}
