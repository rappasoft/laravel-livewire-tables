<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Styling;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
final class FilterSlidedownStylingTest extends TestCase
{
    public function test_filter_slidedown_wrapper_attributes_returns_default_if_not_set(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterSlidedownWrapperAttributes());
    }

    public function test_filter_slidedown_wrapper_attributes_can_be_changed(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterSlidedownWrapperAttributes());
        $this->basicTable->setFilterSlidedownWrapperAttributes([
            'class' => 'text-blue-500',
            'default-colors' => true,
            'default-styling' => true,
            'x-transition:enter' => 'transition ease-out duration-1000',
        ]);

        $this->assertSame(['class' => 'text-blue-500', 'default-colors' => true, 'default-styling' => true, 'x-transition:enter' => 'transition ease-out duration-1000'], $this->basicTable->getFilterSlidedownWrapperAttributes());

        $this->basicTable->setFilterSlidedownWrapperAttributes([
            'x-transition:enter-start' => 'transform opacity-0',
        ]);

        $this->assertSame(['class' => 'text-blue-500', 'default-colors' => true, 'default-styling' => true, 'x-transition:enter' => 'transition ease-out duration-1000', 'x-transition:enter-start' => 'transform opacity-0'], $this->basicTable->getFilterSlidedownWrapperAttributes());

    }

    public function test_filter_slidedown_row_attributes_returns_default_if_not_set(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes(1));
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 2], $this->basicTable->getFilterSlidedownRowAttributes(2));
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes('1'));
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 2], $this->basicTable->getFilterSlidedownRowAttributes('2'));
    }

    public function test_filter_slidedown_row_attributes_can_be_changed(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes(1));

        $this->basicTable->setFilterSlidedownRowAttributes(fn ($rowIndex) => $rowIndex % 2 === 0 ?
        [
            'class' => 'bg-red-500',
            'default-colors' => true,
            'default-styling' => true,
        ] : [
            'class' => 'bg-blue-500',
            'default-colors' => true,
            'default-styling' => true,
        ]
        );
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true, 'row' => 0], $this->basicTable->getFilterSlidedownRowAttributes(0));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes(1));
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true, 'row' => 2], $this->basicTable->getFilterSlidedownRowAttributes(2));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true, 'row' => 3], $this->basicTable->getFilterSlidedownRowAttributes(3));
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true, 'row' => 0], $this->basicTable->getFilterSlidedownRowAttributes('0'));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes('1'));
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true, 'row' => 2], $this->basicTable->getFilterSlidedownRowAttributes('2'));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true, 'row' => 3], $this->basicTable->getFilterSlidedownRowAttributes('3'));

    }

    public function test_filter_slidedown_row_attributes_can_be_changed_and_sets_defaults(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 0], $this->basicTable->getFilterSlidedownRowAttributes(0));
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes(1));

        $this->basicTable->setFilterSlidedownRowAttributes(fn ($rowIndex) => $rowIndex % 2 === 0 ?
        [
            'class' => 'bg-red-500',
            'default-colors' => false,
        ] : [
            'class' => 'bg-blue-500',
            'default-styling' => false,
        ]
        );
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true, 'row' => 0], $this->basicTable->getFilterSlidedownRowAttributes(0));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => false, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes(1));
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true, 'row' => 2], $this->basicTable->getFilterSlidedownRowAttributes(2));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => false, 'row' => 3], $this->basicTable->getFilterSlidedownRowAttributes(3));
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true, 'row' => 0], $this->basicTable->getFilterSlidedownRowAttributes('0'));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => false, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes('1'));
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true, 'row' => 2], $this->basicTable->getFilterSlidedownRowAttributes('2'));
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => false, 'row' => 3], $this->basicTable->getFilterSlidedownRowAttributes('3'));

    }
}
