<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class FooterHelpersTest extends TestCase
{
    public function test_can_get_footer_status(): void
    {
        $this->assertTrue($this->basicTable->footerIsEnabled());

        $this->basicTable->setFooterDisabled();

        $this->assertTrue($this->basicTable->footerIsDisabled());

        $this->basicTable->setFooterEnabled();

        $this->assertTrue($this->basicTable->footerIsEnabled());
    }

    public function test_can_get_use_header_as_footer_status(): void
    {
        $this->assertTrue($this->basicTable->useHeaderAsFooterIsDisabled());

        $this->basicTable->setUseHeaderAsFooterEnabled();

        $this->assertTrue($this->basicTable->useHeaderAsFooterIsEnabled());

        $this->basicTable->setUseHeaderAsFooterDisabled();

        $this->assertTrue($this->basicTable->useHeaderAsFooterIsDisabled());
    }
}
