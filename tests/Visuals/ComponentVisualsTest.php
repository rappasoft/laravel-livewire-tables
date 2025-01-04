<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Exception;
use Illuminate\View\ViewException;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\{BrokenSecondaryHeaderTable, NoBuildMethodTable, NoPrimaryKeyTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable,PetsTableAttributes};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class ComponentVisualsTest extends TestCase
{
    private $testErrors;

    public function test_empty_message_does_not_show_with_results(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('No items found. Try to broaden your search.');
    }

    public function test_empty_message_shows_with_no_results(): void
    {
        Livewire::test(PetsTable::class)
            ->set('search', 'sdfsdfsdfadsfasdfasdd')
            ->assertSee('No items found');
    }

    public function test_debugging_shows_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('Debugging Values')
            ->call('setDebugEnabled')
            ->assertSee('Debugging Values');
    }

    public function test_offline_message_is_available_when_needed(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml('<div wire:offline.class.remove="hidden" class="hidden">');
    }

    public function test_fails_when_table_has_no_pk(): void
    {
        $this->testErrors = false;
        try {
            Livewire::test(NoPrimaryKeyTable::class);
        } catch (DataTableConfigurationException $DataTableConfigurationException) {
            $this->testErrors = true;
            $this->assertSame('You must set a primary key using setPrimaryKey in the configure method, or configuring/configured lifecycle hooks', substr($DataTableConfigurationException->getMessage(), 0, 113));
        } catch (ViewException $ViewException) {
            $this->testErrors = true;

            $this->assertSame('You must set a primary key using setPrimaryKey in the configure method, or configuring/configured lifecycle hooks', substr($ViewException->getMessage(), 0, 113));

        } catch (Exception $standardException) {
            $this->testErrors = true;
            $this->assertSame('You must set a primary key using setPrimaryKey in the configure method, or configuring/configured lifecycle hooks', substr($standardException->getMessage(), 0, 113));
        }
        if (! $this->testErrors) {
            $this->fail('Did Not Throw Error - Missing Primary Key');
        }
    }

    public function test_fails_when_table_has_no_model_or_builder(): void
    {
        $this->testErrors = false;
        try {
            $test = Livewire::test(NoBuildMethodTable::class);
        } catch (DataTableConfigurationException $DataTableConfigurationException) {
            $this->testErrors = true;
            $this->assertSame('You must either specify a model or implement the builder method.', substr($DataTableConfigurationException->getMessage(), 0, 64));

        } catch (ViewException $ViewException) {
            $this->testErrors = true;
            $this->assertSame('You must either specify a model or implement the builder method.', substr($ViewException->getMessage(), 0, 64));
        } catch (Exception $standardException) {
            $this->testErrors = true;
            $this->assertSame('You must either specify a model or implement the builder method.', substr($standardException->getMessage(), 0, 64));
        }

        if (! $this->testErrors) {
            $this->fail('Did Not Throw Error - Missing Model/Builder');
        }
    }

    public function test_can_see_valid_tr_attributes_html(): void
    {
        Livewire::test(PetsTableAttributes::class)
            ->assertSeeHtml('testTrAttribute="testTrAttributeValueForTestSuiteIndex0"')
            ->assertSeeHtml('testTrAttribute="testTrAttributeValueForTestSuiteIndex1"');
    }

    public function test_cannot_see_invalid_tr_attributes_html(): void
    {
        Livewire::test(PetsTableAttributes::class)
            ->assertSeeHtml('testTrAttribute="testTrAttributeValueForTestSuiteIndex0"')
            ->assertDontSeeHtml('testTrAttribute="testTrAttributeValueForTestSuiteNotSeen"');
    }

    public function test_can_see_correct_html_for_clickable_row(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id')
                    ->setTableRowUrl(function ($row) {
                        return 'test';
                    })
                    ->setTableRowUrlTarget(function ($row) {
                        if ($row->id == 2) {
                            return 'navigate';
                        }

                        return '_blank';
                    });

            }
        })->assertSeeHtml("onclick=\"window.open('test', '_blank')")
            ->assertSeeHtmlInOrder([
                'wire:key="table-table-td-2-age"',
                'wire:navigate',
                'href="test"',
                'wire:key="table-table-td-5-age"',
                'onclick="window.open(\'test\', \'_blank\')"',
            ]);

    }

    public function test_column_secondary_header_can_not_be_a_string(): void
    {
        $this->testErrors = false;
        try {
            Livewire::test(BrokenSecondaryHeaderTable::class);
        } catch (DataTableConfigurationException $DataTableConfigurationException) {
            $this->assertSame('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().', substr($DataTableConfigurationException->getMessage(), 0, 111));
            $this->testErrors = true;
        } catch (ViewException $ViewException) {
            $this->assertSame('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().', substr($ViewException->getMessage(), 0, 111));
            $this->testErrors = true;
        } catch (Exception $standardException) {
            $this->assertSame('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().', substr($standardException->getMessage(), 0, 111));
            $this->testErrors = true;
        }
        if (! $this->testErrors) {
            $this->fail('Did Not Throw Error - Missing Primary Key');
        }
    }
}
