<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class QueryStringAliasConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_query_string_alias(): void
    {
        $this->assertSame('test', $this->basicTable->setQueryStringAlias('test')->getQueryStringAlias());
    }
}
