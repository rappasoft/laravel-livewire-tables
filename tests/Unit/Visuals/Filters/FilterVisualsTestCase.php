<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Visuals\Filters;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;

abstract class FilterVisualsTestCase extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        parent::setupBreedsTable();
    }


}