<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FooterConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_footer_status(): void
    {
        $this->assertTrue($this->basicTable->getFooterStatus());

        $this->basicTable->setFooterDisabled();

        $this->assertFalse($this->basicTable->getFooterStatus());

        $this->basicTable->setFooterEnabled();

        $this->assertTrue($this->basicTable->getFooterStatus());

        $this->basicTable->setFooterStatus(false);

        $this->assertFalse($this->basicTable->getFooterStatus());

        $this->basicTable->setFooterStatus(true);

        $this->assertTrue($this->basicTable->getFooterStatus());
    }

    /** @test */
    public function can_set_use_header_as_footer_status(): void
    {
        $this->assertFalse($this->basicTable->getUseHeaderAsFooterStatus());

        $this->basicTable->setUseHeaderAsFooterEnabled();

        $this->assertTrue($this->basicTable->getUseHeaderAsFooterStatus());

        $this->basicTable->setUseHeaderAsFooterDisabled();

        $this->assertFalse($this->basicTable->getUseHeaderAsFooterStatus());

        $this->basicTable->setUseHeaderAsFooterStatus(true);

        $this->assertTrue($this->basicTable->getUseHeaderAsFooterStatus());

        $this->basicTable->setUseHeaderAsFooterStatus(false);

        $this->assertFalse($this->basicTable->getUseHeaderAsFooterStatus());
    }

    /** @test */
    public function can_set_secondary_footer_tr_attributes(): void
    {
        $this->basicTable->setFooterTrAttributes(function ($rows) {
            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getFooterTrAttributes([]), ['default' => true, 'here' => 'there']);
    }

    /** @test */
    public function can_set_footer_td_attributes(): void
    {
        $this->basicTable->setFooterTdAttributes(function (Column $column, $rows) {
            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getFooterTdAttributes(Column::make('ID'), [], 1), ['default' => true, 'here' => 'there']);
    }
}
