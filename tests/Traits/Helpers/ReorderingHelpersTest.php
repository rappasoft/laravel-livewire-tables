<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ReorderingHelpersTest extends TestCase
{
    /** @test */
    public function can_get_reorder_method(): void
    {
        $this->assertSame('reorder', $this->basicTable->getReorderMethod());
    }

    /** @test */
    public function can_get_reorder_status(): void
    {
        $this->assertTrue($this->basicTable->reorderIsDisabled());

        $this->basicTable->setReorderEnabled();

        $this->assertTrue($this->basicTable->reorderIsEnabled());

        $this->basicTable->setReorderDisabled();

        $this->assertTrue($this->basicTable->reorderIsDisabled());
    }

    /** @test */
    public function can_get_currently_reordering_status(): void
    {
        $this->assertTrue($this->basicTable->currentlyReorderingIsDisabled());

        $this->basicTable->setCurrentlyReorderingEnabled();

        $this->assertTrue($this->basicTable->currentlyReorderingIsEnabled());

        $this->basicTable->setCurrentlyReorderingDisabled();

        $this->assertTrue($this->basicTable->currentlyReorderingIsDisabled());
    }

    /** @test */
    public function can_get_hide_reorder_column_unless_reordering_status(): void
    {
        $this->assertTrue($this->basicTable->hideReorderColumnUnlessReorderingIsDisabled());

        $this->basicTable->setHideReorderColumnUnlessReorderingEnabled();

        $this->assertTrue($this->basicTable->hideReorderColumnUnlessReorderingIsEnabled());

        $this->basicTable->setHideReorderColumnUnlessReorderingDisabled();

        $this->assertTrue($this->basicTable->hideReorderColumnUnlessReorderingIsDisabled());
    }

    /** @test */
    public function can_get_default_reorder_column(): void
    {
        $this->assertSame('sort', $this->basicTable->getDefaultReorderColumn());
    }

    /** @test */
    public function can_get_default_reorder_direction(): void
    {
        $this->assertSame('asc', $this->basicTable->getDefaultReorderDirection());
    }

    /** @test */
    public function can_set_reordering_session(): void
    {
        $this->basicTable->setReorderingSession();

        $this->assertTrue($this->basicTable->hasReorderingSession());
    }

    /** @test */
    public function can_forget_reordering_session(): void
    {
        $this->basicTable->setReorderingSession();

        $this->assertTrue($this->basicTable->hasReorderingSession());

        $this->basicTable->forgetReorderingSession();

        $this->assertFalse($this->basicTable->hasReorderingSession());
    }

    /** @test */
    public function can_get_reordering_session_key(): void
    {
        $this->assertSame('table-reordering', $this->basicTable->getReorderingSessionKey());
    }

    /** @test */
    public function can_get_reordering_backup_session_key(): void
    {
        $this->assertSame('table-reordering-backup', $this->basicTable->getReorderingBackupSessionKey());
    }
}
