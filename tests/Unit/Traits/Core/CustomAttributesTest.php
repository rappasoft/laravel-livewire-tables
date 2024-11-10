<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class CustomAttributesTest extends TestCase
{
    public function test_can_get_custom_attribute_defaults_false_standard_mode(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame([
            'default' => false,
            'default-colors' => false,
            'default-styling' => false,
        ], $mock->getCustomAttributes('testAttributesArray', false, true));
    }

    public function test_can_get_custom_attribute_defaults_false_classic_mode(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame([
            'default-colors' => false,
            'default-styling' => false,
        ], $mock->getCustomAttributes('testAttributesArray', false, false));
    }

    public function test_can_get_custom_attribute_defaults_true_standard_mode(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame([
            'default' => true,
            'default-colors' => true,
            'default-styling' => true,
        ], $mock->getCustomAttributes('testAttributesArray', true, true));
    }

    public function test_can_get_custom_attribute_defaults_true_classic_mode(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame([
            'default-colors' => true,
            'default-styling' => true,
        ], $mock->getCustomAttributes('testAttributesArray', true, false));
    }
}
