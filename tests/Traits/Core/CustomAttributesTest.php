<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Core;

use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class CustomAttributesTest extends TestCase
{
    public function test_can_get_custom_attribute_defaults_false_standard_mode(): void
    {
        $this->assertSame([
            'default' => false,
            'default-colors' => true,
            'default-styling' => true,
        ], $this->basicTable->getCustomAttributes('bulkActionsButtonAttributes', false, true));
    }

    public function test_can_get_custom_attribute_defaults_false_classic_mode(): void
    {
        $this->assertSame([
            'default-colors' => true,
            'default-styling' => true,
        ], $this->basicTable->getCustomAttributes('bulkActionsButtonAttributes', false, false));
    }

    public function test_can_get_custom_attribute_defaults_true_standard_mode(): void
    {
        $this->assertSame([
            'default' => true,
            'default-colors' => true,
            'default-styling' => true,
        ], $this->basicTable->getCustomAttributes('bulkActionsButtonAttributes', true, true));
    }

    public function test_can_get_custom_attribute_defaults_true_classic_mode(): void
    {
        $this->assertSame([
            'default-colors' => true,
            'default-styling' => true,
        ], $this->basicTable->getCustomAttributes('bulkActionsButtonAttributes', true, false));
    }
}
