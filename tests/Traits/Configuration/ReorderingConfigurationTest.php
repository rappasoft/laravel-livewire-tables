<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ReorderingConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_reorder_status(): void
    {
        $this->assertFalse($this->basicTable->getReorderStatus());

        $this->basicTable->setReorderEnabled();

        $this->assertTrue($this->basicTable->getReorderStatus());

        $this->basicTable->setReorderDisabled();

        $this->assertFalse($this->basicTable->getReorderStatus());

        $this->basicTable->setReorderStatus(true);

        $this->assertTrue($this->basicTable->getReorderStatus());

        $this->basicTable->setReorderStatus(false);

        $this->assertFalse($this->basicTable->getReorderStatus());
    }

    /** @test */
    public function can_set_currently_reordering_status(): void
    {
        $this->assertFalse($this->basicTable->getCurrentlyReorderingStatus());

        $this->basicTable->setCurrentlyReorderingEnabled();

        $this->assertTrue($this->basicTable->getCurrentlyReorderingStatus());

        $this->basicTable->setCurrentlyReorderingDisabled();

        $this->assertFalse($this->basicTable->getCurrentlyReorderingStatus());

        $this->basicTable->setCurrentlyReorderingStatus(true);

        $this->assertTrue($this->basicTable->getCurrentlyReorderingStatus());

        $this->basicTable->setCurrentlyReorderingStatus(false);

        $this->assertFalse($this->basicTable->getCurrentlyReorderingStatus());
    }

    /** @test */
    public function can_set_hide_reorder_column_unless_reordering_status(): void
    {
        $this->assertFalse($this->basicTable->getHideReorderColumnUnlessReorderingStatus());

        $this->basicTable->setHideReorderColumnUnlessReorderingEnabled();

        $this->assertTrue($this->basicTable->getHideReorderColumnUnlessReorderingStatus());

        $this->basicTable->setHideReorderColumnUnlessReorderingDisabled();

        $this->assertFalse($this->basicTable->getHideReorderColumnUnlessReorderingStatus());

        $this->basicTable->setHideReorderColumnUnlessReorderingStatus(true);

        $this->assertTrue($this->basicTable->getHideReorderColumnUnlessReorderingStatus());

        $this->basicTable->setHideReorderColumnUnlessReorderingStatus(false);

        $this->assertFalse($this->basicTable->getHideReorderColumnUnlessReorderingStatus());
    }

    /** @test */
    public function can_set_reorder_method(): void
    {
        $this->assertSame('reorder', $this->basicTable->getReorderMethod());

        $this->basicTable->setReorderMethod('reorderMe');

        $this->assertSame('reorderMe', $this->basicTable->getReorderMethod());
    }

    /** @test */
    public function can_set_default_reorder_column_and_direction(): void
    {
        $this->assertSame('sort', $this->basicTable->getDefaultReorderColumn());
        $this->assertSame('asc', $this->basicTable->getDefaultReorderDirection());

        $this->basicTable->setDefaultReorderSort('sort2', 'desc');

        $this->assertSame('sort2', $this->basicTable->getDefaultReorderColumn());
        $this->assertSame('desc', $this->basicTable->getDefaultReorderDirection());
    }
}
