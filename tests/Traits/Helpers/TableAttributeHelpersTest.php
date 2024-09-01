<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class TableAttributeHelpersTest extends TestCase
{
    public function test_top_level_attributes_match(): void
    {
        $topLevelAttributesArray = $this->basicTable->getTopLevelAttributesArray();

    }


}