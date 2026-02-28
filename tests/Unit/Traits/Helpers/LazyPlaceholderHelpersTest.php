<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class LazyPlaceholderHelpersTest extends TestCase
{
    public function test_can_get_lazy_placeholder_enabled_status(): void
    {
        $this->assertTrue($this->basicTable->getLazyPlaceholderEnabled());

        $this->basicTable->setLazyPlaceholderDisabled();

        $this->assertFalse($this->basicTable->getLazyPlaceholderEnabled());
    }

    public function test_can_check_has_lazy_placeholder_enabled(): void
    {
        $this->assertTrue($this->basicTable->hasLazyPlaceholderEnabled());

        $this->basicTable->setLazyPlaceholderDisabled();

        $this->assertFalse($this->basicTable->hasLazyPlaceholderEnabled());
    }

    public function test_can_check_has_lazy_placeholder_view(): void
    {
        $this->assertFalse($this->basicTable->hasLazyPlaceholderView());

        $this->basicTable->setLazyPlaceholderView('livewire-tables-test::test');

        $this->assertTrue($this->basicTable->hasLazyPlaceholderView());
    }

    public function test_can_get_lazy_placeholder_view(): void
    {
        $this->assertNull($this->basicTable->getLazyPlaceholderView());

        $this->basicTable->setLazyPlaceholderView('livewire-tables-test::test');

        $this->assertSame('livewire-tables-test::test', $this->basicTable->getLazyPlaceholderView());
    }

    public function test_lazy_placeholder_is_enabled_by_default(): void
    {
        $this->assertTrue($this->basicTable->hasLazyPlaceholderEnabled());
    }

    public function test_lazy_placeholder_view_is_null_by_default(): void
    {
        $this->assertNull($this->basicTable->getLazyPlaceholderView());
        $this->assertFalse($this->basicTable->hasLazyPlaceholderView());
    }
}
