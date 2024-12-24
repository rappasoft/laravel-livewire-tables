<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Styling;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

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

        $this->assertSame('block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50', $this->basicTable->getDefaultFilterInputStyling());
    }

    public function test_can_set_filter_default_input_styling(): void
    {
        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();

            }

            public function setDefaultFilterInputStyling(string $defaultFilterInputStyling): self
            {
                parent::setDefaultFilterInputStyling($defaultFilterInputStyling);

                return $this;
            }



        };

        $testTableDefault->configure();
        $testTableDefault->boot();
        $testTableDefault->bootedComponentUtilities();
        $testTableDefault->bootedWithData();
        $testTableDefault->bootedWithColumns();
        $testTableDefault->bootedWithColumnSelect();
        $testTableDefault->bootedWithSecondaryHeader();
        $testTableDefault->booted();

        $this->assertFalse($testTableDefault->hasDefaultFilterInputStyling());

        $testTableDefault->setDefaultFilterInputStyling('p-4');

        $this->assertTrue($testTableDefault->hasDefaultFilterInputStyling());

        $this->assertSame('p-4', $testTableDefault->getDefaultFilterInputStyling());

    }

    public function test_has_filter_default_input_colors(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputColors());
    }

    public function test_can_set_filter_default_input_colors(): void
    {

        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();

            }


            public function setDefaultFilterInputColors(string $defaultFilterInputColors): self
            {
                parent::setDefaultFilterInputColors($defaultFilterInputColors);

                return $this;
            }


        };

        $testTableDefault->configure();
        $testTableDefault->boot();
        $testTableDefault->bootedComponentUtilities();
        $testTableDefault->bootedWithData();
        $testTableDefault->bootedWithColumns();
        $testTableDefault->bootedWithColumnSelect();
        $testTableDefault->bootedWithSecondaryHeader();
        $testTableDefault->booted();
        $this->assertFalse($testTableDefault->hasDefaultFilterInputColors());

        $testTableDefault->setDefaultFilterInputColors('bg-blue-500');

        $this->assertTrue($testTableDefault->hasDefaultFilterInputColors());

        $this->assertSame('bg-blue-500', $testTableDefault->getDefaultFilterInputColors());

    }

    public function test_can_get_filter_default_input_colors(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultFilterInputColors());

        $this->assertSame('border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600', $this->basicTable->getDefaultFilterInputColors());
    }
}
