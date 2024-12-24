<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Styling;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
#[Group('Styling')]
final class FilterInputDefaultStylingTest extends TestCase
{
    public function test_has_filter_default_input_styling(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputStyling());
    }

    public function test_can_get_filter_default_input_styling(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputStyling());

        $this->assertSame('block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50', $this->getDefaultFilterInputStyling());
    }

    public function test_can_set_filter_default_input_styling(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputStyling());

        $this->basicTable->setDefaultFilterInputStyling('p-4');

        $this->assertTrue($this->basicTable->hasDefaultFilterInputStyling());
    }

    public function test_has_filter_default_input_colors(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputColors());
    }

    public function test_can_set_filter_default_input_colors(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputColors());

        $this->basicTable->setDefaultFilterInputColors('bg-blue-500');

        $this->assertTrue($this->basicTable->hasDefaultFilterInputColors());
    }

    public function test_can_get_filter_default_input_colors(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputColors());

        $this->assertSame('border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600', $this->getDefaultFilterInputColors());
    }
}
