<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class BootstrapToolbarVisualsTest extends TestCase
{
    public static function themes(): array
    {
        return [['bootstrap-4'], ['bootstrap-5']];
    }

    #[DataProvider('themes')]
    public function test_bootstrap_preserves_custom_attributes_and_icons(string $theme): void
    {
        config(['livewire-tables.theme' => $theme]);
        $table = Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setFilterLayoutPopover();
                $this->setSearchPlaceholder('Find pets');
                $this->setSearchDebounce(750);
                $this->setSearchFieldAttributes(['data-search' => 'kept', 'class' => 'custom-search']);
                $this->setSearchIcon('heroicon-o-adjustments-horizontal');
                $this->setSearchIconAttributes(['data-icon' => 'kept']);
                $this->setPerPageFieldAttributes(['data-per-page' => 'kept']);
                $this->setColumnSelectMenuOptionCheckboxAttributes(['data-column' => 'kept']);
                $this->setFilterButtonAttributes(['data-filter-button' => 'kept']);
                $this->setFilterButtonBadgeAttributes(['data-filter-badge' => 'kept']);
                $this->setFilterPopoverAttributes(['data-popover' => 'kept']);
            }

            public function filters(): array
            {
                $filters = parent::filters();
                $filters[0]->setInputAttributes(['data-filter-input' => 'kept', 'class' => 'custom-filter']);

                return $filters;
            }
        })
            ->call('setFilter', 'breed', ['1'])
            ->assertSeeHtml('data-search="kept"')
            ->assertSeeHtml('data-icon="kept"')
            ->assertSeeHtml('data-per-page="kept"')
            ->assertSeeHtml('data-filter-button="kept"')
            ->assertSeeHtml('data-filter-badge="kept"')
            ->assertSeeHtml('data-filter-input="kept"')
            ->assertSeeHtml('data-popover="kept"')
            ->assertSeeHtml('class="dropdown-menu lwt-filter-popover"')
            ->assertSeeHtml('wire:model.live.debounce.750ms="search"')
            ->assertSeeHtml('placeholder="Find pets"')
            ->assertDontSeeHtml('bi bi-');

        if ($theme === 'bootstrap-5') {
            $table->assertSeeHtml('data-column="kept"');
        }
    }

    #[DataProvider('themes')]
    public function test_bootstrap_can_disable_search_icon_and_default_input_styling(string $theme): void
    {
        config(['livewire-tables.theme' => $theme]);
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setSearchFieldAttributes(['data-search' => 'custom', 'class' => 'plain-search']);
                $this->setSearchIcon('heroicon-o-adjustments-horizontal');
                $this->setSearchIconAttributes(['data-hidden-icon' => 'hidden']);
                $this->searchIconDisabled();
                $this->setPerPageFieldAttributes(['class' => 'plain-per-page', 'default-styling' => false]);
                $this->setColumnSelectMenuOptionCheckboxAttributes(['data-column' => 'custom', 'default-styling' => false]);
            }
        })
            ->assertSeeHtml('data-search="custom"')
            ->assertSeeHtml('class="plain-search"')
            ->assertSeeHtml('class="plain-per-page"')
            ->assertDontSeeHtml('data-hidden-icon="hidden"')
            ->assertDontSeeHtml('lwt-search--icon')
            ->assertDontSeeHtml('lwt-search__input')
            ->assertDontSeeHtml('lwt-perpage__select');
    }

    #[DataProvider('themes')]
    public function test_bootstrap_toolbar_controls_still_update_table_state(string $theme): void
    {
        config(['livewire-tables.theme' => $theme]);
        $table = Livewire::test(PetsTable::class)
            ->assertSeeHtml('lwt-toolbar')
            ->assertSeeHtml('wire:model.live="perPage"')
            ->assertSeeHtml('wire:model.live="selectedColumns"')
            ->call('setSearch', 'Cartman')
            ->assertSee('Cartman')
            ->assertDontSee('Chico')
            ->assertSeeHtml('wire:click="clearSearch"')
            ->assertSeeHtml('aria-label="Clear"')
            ->call('clearSearch')
            ->assertSee('Chico')
            ->set('perPage', 25)
            ->assertSet('perPage', 25);

        $this->assertSame(25, $table->instance()->getPerPage());
        $table->call('selectAllFilterOptions', 'breed');
        $this->assertSame(array_keys($table->instance()->getFilterByKey('breed')->getOptions()), $table->instance()->getAppliedFilterWithValue('breed'));
        $table->call('selectAllFilterOptions', 'breed');
        $this->assertEmpty($table->instance()->getAppliedFilterWithValue('breed'));
        $table->call('selectAllColumns');
        $this->assertSame($table->instance()->getSelectableColumns()->count(), $table->instance()->getSelectableSelectedColumns()->count());
        $table->call('deselectAllColumns');
        $this->assertSame(0, $table->instance()->getSelectableSelectedColumns()->count());
    }
}
