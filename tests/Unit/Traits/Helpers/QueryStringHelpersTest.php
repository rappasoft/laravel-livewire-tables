<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class QueryStringHelpersTest extends TestCase
{
    public function test_check_querystring_returns_empty_if_disabled(): void
    {

        $testTableQueryString = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setQueryStringDisabled();
            }

            public function getCurrentQueryStringBinding(): array
            {
                return $this->queryStringWithQueryString();
            }
        };

        $testTableQueryString->bootAll();

        $this->assertSame([], $testTableQueryString->getCurrentQueryStringBinding());

    }

    public function test_check_querystring_returns_default_if_enabled(): void
    {

        $testTableQueryString = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setQueryStringEnabled();
            }

            public function getCurrentQueryStringBinding(): array
            {
                return $this->queryStringWithQueryString();
            }
        };

        $testTableQueryString->bootAll();

        $this->assertSame(['table' => ['except' => null, 'history' => false, 'keep' => false, 'as' => 'table']], $testTableQueryString->getCurrentQueryStringBinding());

    }

    public function test_check_querystring_alias_returns_default_if_enabled(): void
    {

        $testTableQueryString = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setQueryStringEnabled();
            }

            public function getCurrentQueryStringBinding(): array
            {
                return $this->queryStringWithQueryString();
            }
        };

        $testTableQueryString->bootAll();

        $this->assertFalse($testTableQueryString->hasQueryStringAlias());
        $this->assertSame('table', $testTableQueryString->getQueryStringAlias());
        $this->assertSame(['table' => ['except' => null, 'history' => false, 'keep' => false, 'as' => 'table']], $testTableQueryString->getCurrentQueryStringBinding());

        $testTableQueryString->setQueryStringAlias('test123');

        $this->assertTrue($testTableQueryString->hasQueryStringAlias());
        $this->assertSame('test123', $testTableQueryString->getQueryStringAlias());
        $this->assertSame(['table' => ['except' => null, 'history' => false, 'keep' => false, 'as' => 'test123']], $testTableQueryString->getCurrentQueryStringBinding());

    }
}
