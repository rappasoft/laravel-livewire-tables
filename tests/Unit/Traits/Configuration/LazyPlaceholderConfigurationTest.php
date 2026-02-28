<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class LazyPlaceholderConfigurationTest extends TestCase
{
    public function test_can_set_lazy_placeholder_status_enabled(): void
    {
        $this->assertTrue($this->basicTable->hasLazyPlaceholderEnabled());

        $this->basicTable->setLazyPlaceholderDisabled();

        $this->assertFalse($this->basicTable->hasLazyPlaceholderEnabled());

        $this->basicTable->setLazyPlaceholderEnabled();

        $this->assertTrue($this->basicTable->hasLazyPlaceholderEnabled());
    }

    public function test_can_set_lazy_placeholder_status_disabled(): void
    {
        $this->assertTrue($this->basicTable->hasLazyPlaceholderEnabled());

        $this->basicTable->setLazyPlaceholderDisabled();

        $this->assertFalse($this->basicTable->hasLazyPlaceholderEnabled());
    }

    public function test_can_set_lazy_placeholder_status_via_bool(): void
    {
        $this->assertTrue($this->basicTable->hasLazyPlaceholderEnabled());

        $this->basicTable->setLazyPlaceholderStatus(false);

        $this->assertFalse($this->basicTable->hasLazyPlaceholderEnabled());

        $this->basicTable->setLazyPlaceholderStatus(true);

        $this->assertTrue($this->basicTable->hasLazyPlaceholderEnabled());
    }

    public function test_can_set_lazy_placeholder_view(): void
    {
        $this->assertFalse($this->basicTable->hasLazyPlaceholderView());

        $this->assertNull($this->basicTable->getLazyPlaceholderView());

        $this->basicTable->setLazyPlaceholderView('livewire-tables-test::test');

        $this->assertTrue($this->basicTable->hasLazyPlaceholderView());

        $this->assertSame('livewire-tables-test::test', $this->basicTable->getLazyPlaceholderView());
    }

    public function test_set_lazy_placeholder_view_returns_self(): void
    {
        $result = $this->basicTable->setLazyPlaceholderView('livewire-tables-test::test');

        $this->assertSame($this->basicTable, $result);
    }

    public function test_set_lazy_placeholder_enabled_returns_self(): void
    {
        $result = $this->basicTable->setLazyPlaceholderEnabled();

        $this->assertSame($this->basicTable, $result);
    }

    public function test_set_lazy_placeholder_disabled_returns_self(): void
    {
        $result = $this->basicTable->setLazyPlaceholderDisabled();

        $this->assertSame($this->basicTable, $result);
    }

    public function test_set_lazy_placeholder_status_returns_self(): void
    {
        $result = $this->basicTable->setLazyPlaceholderStatus(true);

        $this->assertSame($this->basicTable, $result);
    }
}
