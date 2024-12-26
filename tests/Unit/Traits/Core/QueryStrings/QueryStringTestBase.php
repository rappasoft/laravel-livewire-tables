<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('QueryString')]
class QueryStringTestBase extends TestCase
{
    protected static $mock;

    protected function setUp(): void
    {
        self::$mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };
    }
}
