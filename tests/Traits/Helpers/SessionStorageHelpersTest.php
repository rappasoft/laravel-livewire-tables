<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class SessionStorageHelpersTest extends TestCase
{
    public function test_can_get_session_storage_status_for_filters(): void
    {
        $this->assertFalse($this->basicTable->shouldStoreFiltersInSession());

        $this->basicTable->storeFiltersInSessionEnabled();

        $this->assertTrue($this->basicTable->shouldStoreFiltersInSession());

        $this->basicTable->storeFiltersInSessionDisabled();

        $this->assertFalse($this->basicTable->shouldStoreFiltersInSession());

    }

    public function test_can_get_session_storage_status_filter_key(): void
    {
        $this->assertSame($this->basicTable->getTableName().'-stored-filters', $this->basicTable->getFilterSessionKey());
    }
}
