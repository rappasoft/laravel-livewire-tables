<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class BulkActionsVisualsTest extends TestCase
{
    public function test_bulk_dropdown_shows_when_necessary(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('No items found. Try to broaden your search.');
    }

    /*
    public function test_bulk_dropdown_shows_when_necessary(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSee('Bulk Actions')
            ->call('setBulkActionsEnabled')
            ->assertDontSee('Bulk Actions')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertSee('Bulk Actions')
            ->call('setBulkActions', [])
            ->call('setHideBulkActionsWhenEmptyEnabled')
            ->assertDontSee('Bulk Actions')
            ->call('setSelected', [1, 2, 3])
            ->assertSee('Bulk Actions');
    }*/

    /*
    public function test_select_all_header_shows_if_bulk_actions_enabled_and_available(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSee('Select All')
            ->call('setBulkActionsEnabled')
            ->assertDontSee('Select All')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertDontSee('Select All');
    }*/

    /*
    public function test_select_cell_shows_if_bulk_actions_enabled_and_available(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSee('Select All')
            ->call('setBulkActionsEnabled')
            ->assertDontSee('Select All')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertDontSee('Select All');
    }*/

    /*public function test_bulk_actions_row_shows_if_bulk_actions_enabled_and_available_and_selected(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSeeHtml('wire:key="bulk-select-message-table"')
            ->call('setBulkActionsEnabled')
            ->assertDontSeeHtml('wire:key="bulk-select-message-table"')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertDontSeeHtml('wire:key="bulk-select-message-table"')
            ->call('setSelected', [1, 2, 3])
            ->assertSeeHtml('wire:key="bulk-select-message-table"');
    }*/

    /*
    public function test_bulk_actions_row_shows_correct_for_select_some(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSee('do you want to select all')
            ->call('setBulkActionsEnabled')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->call('setSelected', [1, 2, 3])
            ->assertSee('do you want to select all')
            ->assertDontSee('You are currently selecting all');
    }*/

    public function test_bulk_dropdown_shows_when_necessary_extended(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertSee('Bulk Actions');
    }

    public function test_bulk_dropdown_shows_when_not_permanently_hidden(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id')
                    ->setShouldAlwaysHideBulkActionsDropdownOption(false);
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertSee('Bulk Actions');
    }

    public function test_bulk_dropdown_hides_when_permanently_hidden(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id')
                    ->setShouldAlwaysHideBulkActionsDropdownOption(true);
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertDontSee('Bulk Actions');
    }

    public function test_bulk_dropdown_shows_when_not_permanently_hidden_disabled(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id')
                    ->setShouldAlwaysHideBulkActionsDropdownOptionDisabled();
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertSee('Bulk Actions');
    }

    public function test_bulk_dropdown_hides_when_permanently_hidden_enabled(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id')
                    ->setShouldAlwaysHideBulkActionsDropdownOptionEnabled();
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertDontSee('Bulk Actions');
    }

    public function test_bulk_dropdown_can_have_customised_classes_with_no_defaults(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setBulkActionsThAttributes([
                    'class' => 'bg-yellow-500 dark:bg-yellow-800',
                    'default' => false,
                    'default-styling' => false,
                    'default-colors' => false,
                ]);

            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertSee('Bulk Actions')
            ->assertSeeHtmlInOrder([
                'scope="col"',
                'class="bg-yellow-500 dark:bg-yellow-800"',
                'wire:key="table-thead-bulk-actions"',
            ]);
    }

    public function test_bulk_dropdown_can_have_customised_classes_with_default_styling(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setBulkActionsThAttributes([
                    'class' => 'bg-yellow-500 dark:bg-yellow-800',
                    'default' => false,
                    'default-styling' => true,
                    'default-colors' => false,
                ]);

            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertSee('Bulk Actions')
            ->assertSeeHtmlInOrder([
                'scope="col"',
                'class="table-cell px-3 py-2 md:px-6 md:py-3 text-center md:text-left laravel-livewire-tables-reorderingMinimised bg-yellow-500 dark:bg-yellow-800"',
                'wire:key="table-thead-bulk-actions"',
            ]);
    }

    public function test_bulk_dropdown_can_have_customised_classes_with_default_colors(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setBulkActionsThAttributes([
                    'class' => 'text-lg',
                    'default' => false,
                    'default-styling' => false,
                    'default-colors' => true,
                ]);

            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertSee('Bulk Actions')
            ->assertSeeHtmlInOrder([
                'scope="col"',
                'class="bg-gray-50 dark:bg-gray-800 text-lg"',
                'wire:key="table-thead-bulk-actions"',
            ]);
    }

    public function test_bulk_dropdown_can_have_customised_classes_with_defaults(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setBulkActionsThAttributes([
                    'class' => 'text-lg',
                    'default' => true,
                    'default-styling' => true,
                    'default-colors' => true,
                ]);

            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->assertSee('Bulk Actions')
            ->assertSeeHtmlInOrder([
                'scope="col"',
                'class="table-cell px-3 py-2 md:px-6 md:py-3 text-center md:text-left laravel-livewire-tables-reorderingMinimised bg-gray-50 dark:bg-gray-800 text-lg"',
                'wire:key="table-thead-bulk-actions"',
            ]);
    }
}
