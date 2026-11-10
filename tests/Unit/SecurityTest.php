<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Livewire\Exceptions\MethodNotFoundException;
use Livewire\Features\SupportLockedProperties\CannotUpdateLockedPropertyException;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FilteredBulkActionsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ColorColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\LivewireComponentArrayFilter;

/** The suite's BaseTable opens every method to the browser; these fixtures behave like a real table. */
trait UsesPackageBrowserCallableMethods
{
    public function browserCallableMethods(): array
    {
        return DataTableComponent::browserCallableMethods();
    }
}

class LockedDownPetsTable extends PetsTable
{
    use UsesPackageBrowserCallableMethods;

    public function definedByTheApplication(): void
    {
        $this->setSearch('Cartman');
    }
}

/** Owner 1 owns pets 1 and 4 only. */
class OwnerScopedPetsTable extends LockedDownPetsTable
{
    public function configure(): void
    {
        parent::configure();
        $this->setReorderEnabled();
    }

    public function builder(): Builder
    {
        return Pet::query()->where('pets.owner_id', 1);
    }

    /** Writes whatever it is given, like the upsert in docs/reordering/saving.md */
    public function reorder(array $items): void
    {
        foreach ($items as $item) {
            Pet::query()->updateOrInsert(['id' => $item['id']], $item);
        }
    }
}

class ReorderDisabledPetsTable extends OwnerScopedPetsTable
{
    public function configure(): void
    {
        parent::configure();
        $this->setReorderDisabled();
    }
}

class ColorPetsTable extends PetsTable
{
    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            ColorColumn::make('Favorite Color', 'favorite_color'),
        ];
    }
}

class ExternalArrayFilterPetsTable extends PetsTable
{
    public function filters(): array
    {
        return [...parent::filters(), LivewireComponentArrayFilter::make('External', 'external_filter')];
    }
}

final class SecurityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // The sqlite file is shared by the whole suite
        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::rollBack();

        parent::tearDown();
    }

    private static function livewireCall(string $method, mixed ...$params): array
    {
        return ['method' => $method, 'params' => $params, 'path' => ''];
    }

    public static function configurationMethods(): array
    {
        return [
            ['setPrimaryKey', ['favorite_color']],
            ['setAdditionalSelects', ['pets.favorite_color']],
            ['setConfigurableArea', ['before-tools', 'some.view']],
            ['setReorderMethod', ['definedByTheApplication']],
            ['setDebugEnabled', []],
            ['setPaginationDisabled', []],
            ['setBulkActions', [['x' => 'y']]],
            ['updateLivewireArrayFilterValues', ['breed_select_filter', 'table', []]],
            ['getSelectedRows', []],
            ['SETPRIMARYKEY', ['favorite_color']],
        ];
    }

    #[DataProvider('configurationMethods')]
    public function test_browser_cannot_call_configuration_methods(string $method, array $params): void
    {
        $this->expectException(MethodNotFoundException::class);

        Livewire::test(LockedDownPetsTable::class)->call($method, ...$params);
    }

    public function test_browser_cannot_read_another_column_through_the_primary_key(): void
    {
        $component = Livewire::test(LockedDownPetsTable::class);

        try {
            $component->update(calls: [self::livewireCall('setPrimaryKey', 'favorite_color'), self::livewireCall('setAllSelected')]);
        } catch (MethodNotFoundException) {
        }

        $this->assertNotContains('#000000', $component->get('selected'));
    }

    public function test_browser_cannot_include_a_view_through_a_configurable_area(): void
    {
        $dir = sys_get_temp_dir().'/lt-security-views';
        @mkdir($dir);
        file_put_contents($dir.'/admin-only.blade.php', 'ADMIN-ONLY-VIEW');
        View::addLocation($dir);

        $component = Livewire::test(LockedDownPetsTable::class);

        try {
            $component->call('setConfigurableArea', 'before-tools', 'admin-only');
        } catch (MethodNotFoundException) {
        }

        $this->assertStringNotContainsString('ADMIN-ONLY-VIEW', $component->html());
    }

    public function test_browser_can_still_call_what_the_frontend_and_the_application_use(): void
    {
        Livewire::test(LockedDownPetsTable::class)
            ->call('sortBy', 'id')
            ->assertSet('sorts', ['id' => 'asc'])
            ->call('clearSort', 'id')
            ->call('clearSorts')
            ->call('setFilter', 'breed', ['1'])
            ->call('resetFilter', 'breed')
            ->call('selectAllFilterOptions', 'breed')
            ->call('setFilterDefaults')
            ->call('deselectAllColumns')
            ->call('selectAllColumns')
            ->call('setAllSelected')
            ->assertSet('selected', ['1', '2', '3', '4', '5'])
            ->call('clearSelected')
            ->call('clearSearch')
            ->call('setPage', 1)
            ->call('definedByTheApplication')
            ->assertSet('search', 'Cartman');

        foreach ((new LockedDownPetsTable)->browserCallableMethods() as $method) {
            $this->assertTrue(method_exists(DataTableComponent::class, $method), $method);
        }
    }

    public function test_reorder_only_receives_the_position_of_rows_in_the_table(): void
    {
        Livewire::test(OwnerScopedPetsTable::class)->call('storeReorder', [
            ['id' => 1, 'sort' => 7, 'name' => 'pwned'],   // extra column
            ['id' => 2, 'sort' => 8],                       // another owner's pet
            ['id' => 999, 'sort' => 9, 'name' => 'new'],    // does not exist
            ['id' => 4, 'sort' => '3; drop table pets'],    // not a position
            'not a row',
        ]);

        $this->assertSame(['Cartman', 7], [Pet::find(1)->name, (int) Pet::find(1)->sort]);
        $this->assertSame(0, (int) Pet::find(2)->sort);
        $this->assertSame(0, (int) Pet::find(4)->sort);
        $this->assertNull(Pet::find(999));
    }

    public function test_reorder_does_nothing_when_reordering_is_disabled(): void
    {
        Livewire::test(ReorderDisabledPetsTable::class)
            ->call('storeReorder', [['id' => 1, 'sort' => 7]])
            ->call('enableReordering')
            ->assertSet('reorderStatus', false)
            ->assertSet('currentlyReorderingStatus', false)
            ->assertSet('paginationStatus', true);

        $this->assertSame(0, (int) Pet::find(1)->sort);
    }

    public static function reorderProperties(): array
    {
        return [['defaultReorderColumn', 'favorite_color'], ['currentlyReorderingStatus', true], ['reorderStatus', true]];
    }

    #[DataProvider('reorderProperties')]
    public function test_browser_cannot_set_reorder_properties(string $property, mixed $value): void
    {
        $this->expectException(CannotUpdateLockedPropertyException::class);

        Livewire::test(LockedDownPetsTable::class)->set($property, $value);
    }

    public function test_link_and_image_column_attributes_are_escaped(): void
    {
        // PetsTable uses the documented 'alt' => $row->name.' Avatar'
        Pet::where('id', 1)->update(['name' => 'x" onmouseover="alert(1)']);

        $html = Livewire::test(PetsTable::class)->html();

        $this->assertStringNotContainsString(' onmouseover="alert(1)', $html);
        $this->assertStringContainsString('alt="x&quot; onmouseover=&quot;alert(1) Avatar"', $html);
    }

    public function test_color_column_colour_is_escaped(): void
    {
        Pet::where('id', 1)->update(['favorite_color' => 'red" onmouseover="alert(1)']);

        $this->assertStringNotContainsString(' onmouseover="alert(1)', Livewire::test(ColorPetsTable::class)->html());
    }

    public function test_selection_is_limited_to_rows_in_the_table(): void
    {
        // pets 2 and 3 belong to other owners
        Livewire::test(OwnerScopedPetsTable::class)
            ->set('selected', ['1', '2', '3', '4', '999', ['nested']])
            ->assertSet('selected', ['1', '4']);
    }

    public function test_selection_is_limited_to_rows_the_row_filter_allows(): void
    {
        // setBulkActionsRowFilter(fn (Pet $row) => $row->id !== 2)
        Livewire::test(FilteredBulkActionsTable::class)
            ->set('selected', ['1', '2', '3'])
            ->assertSet('selected', ['1', '3']);
    }

    public function test_browser_cannot_replace_the_options_a_select_filter_validates_against(): void
    {
        $component = Livewire::test(LockedDownPetsTable::class)->update(
            calls: [self::livewireCall('__dispatch', 'livewireArrayFilterUpdateValues', ['filterKey' => 'breed_select_filter', 'tableName' => 'table', 'values' => ['not-an-option' => 'x']])],
            updates: ['filterComponents.breed_select_filter' => 'not-an-option'],
        );

        $this->assertArrayNotHasKey('breed_select_filter', $component->instance()->getAppliedFiltersWithValues());
    }

    public function test_only_external_array_filters_take_their_options_from_an_event(): void
    {
        $table = new ExternalArrayFilterPetsTable;
        $table->bootAll();
        $selectOptions = $table->getFilterByKey('breed_select_filter')->getOptions();

        $table->updateLivewireArrayFilterValues('external_filter', 'table', ['1' => 'One']);
        $this->assertSame(['1' => 'One'], $table->getFilterByKey('external_filter')->getOptions());

        $table->updateLivewireArrayFilterValuesNew('external_filter', 'table', [['id' => '2', 'value' => 'Two']]);
        $this->assertSame(['2' => 'Two'], $table->getFilterByKey('external_filter')->getOptions());

        $table->updateLivewireArrayFilterValues('breed_select_filter', 'table', ['x' => 'y']);
        $table->updateLivewireArrayFilterValuesNew('breed_select_filter', 'table', [['id' => 'x', 'value' => 'y']]);
        $this->assertSame($selectOptions, $table->getFilterByKey('breed_select_filter')->getOptions());
    }
}
