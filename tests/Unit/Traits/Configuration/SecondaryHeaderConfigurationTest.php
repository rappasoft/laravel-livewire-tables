<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

final class SecondaryHeaderConfigurationTest extends TestCase
{
    public function test_can_set_secondary_header_status(): void
    {
        $this->assertTrue($this->basicTable->getSecondaryHeaderStatus());

        $this->basicTable->setSecondaryHeaderDisabled();

        $this->assertFalse($this->basicTable->getSecondaryHeaderStatus());

        $this->basicTable->setSecondaryHeaderEnabled();

        $this->assertTrue($this->basicTable->getSecondaryHeaderStatus());

        $this->basicTable->setSecondaryHeaderStatus(false);

        $this->assertFalse($this->basicTable->getSecondaryHeaderStatus());

        $this->basicTable->setSecondaryHeaderStatus(true);

        $this->assertTrue($this->basicTable->getSecondaryHeaderStatus());
    }

    public function test_can_set_secondary_header_tr_attributes(): void
    {
        $this->basicTable->setSecondaryHeaderTrAttributes(function ($rows) {
            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getSecondaryHeaderTrAttributes([]), ['default' => true, 'here' => 'there']);
    }

    public function test_can_set_secondary_header_td_attributes(): void
    {
        $this->basicTable->setSecondaryHeaderTdAttributes(function (Column $column, $rows) {
            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getSecondaryHeaderTdAttributes(Column::make('ID'), [], 1), ['default' => true, 'here' => 'there']);
    }
}
