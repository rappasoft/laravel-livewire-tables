<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class QueryStringAliasConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_query_string_alias(): void
    {
        $this->assertSame('test', $this->basicTable->setQueryStringAlias('test')->getQueryStringAlias());
    }

    /** @test */
    public function can_set_query_string_in_configure_method(): void
    {
        $mock = new class extends PetsTable {
            public function configure(): void
            {
                $this->setQueryStringAlias('test');
            }
        };
    
        $mock->configure();
        $mock->boot();
    
        $this->assertSame('test', $mock->getQueryStringAlias());
    }
}
