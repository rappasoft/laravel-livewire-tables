<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Traits\WithBulkActions;
use Rappasoft\LaravelLivewireTables\Traits\WithCustomPagination;
use Rappasoft\LaravelLivewireTables\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Traits\WithPerPagePagination;
use Rappasoft\LaravelLivewireTables\Traits\WithSorting;

/**
 * Class TableComponent.
 */
abstract class DataTableComponent extends Component
{
    use WithBulkActions;
    use WithCustomPagination;
    use WithFilters;
    use WithPerPagePagination;
    use WithSorting;

    /**
     * The default pagination theme.
     *
     * @var string
     */
    public $paginationTheme = 'tailwind';

    /**
     * Show the search field.
     *
     * @var bool
     */
    public bool $showSearch = true;

    /**
     * Show the per page select.
     *
     * @var bool
     */
    public bool $showPerPage = true;

    /**
     * Show the pagination numbers and links.
     *
     * @var bool
     */
    public bool $showPagination = true;

    /**
     * Show the sorting indicators.
     *
     * @var bool
     */
    public bool $showSorting = true;

    /**
     * Show the filtering indicators.
     *
     * @var bool
     */
    public bool $showFilters = true;

    /**
     * Whether or not to refresh the table at a certain interval
     * false is off
     * If it's an integer it will be treated as milliseconds (2000 = refresh every 2 seconds)
     * If it's a string it will call that function every 5 seconds.
     *
     * @var bool|string
     */
    public $refresh = false;

    /**
     * Whether or not to display an offline message when there is no connection.
     *
     * @var bool
     */
    public $offlineIndicator = true;

    /**
     * Name of the page parameter for pagination
     * Good to change the default if you have more than one datatable on a page.
     *
     * @var string
     */
    protected string $pageName = 'page';

    /**
     * Unique name to use for this table if you want the 'per page' options to be remembered on a per table basis.
     * If not, all 'per page' stored in the session will default to the same option for every table with this default name.
     *
     * I.e. If the users changes it to 25 on the users table, the roles table will also default to 25, unless they have unique tableName's
     *
     * @var string
     */
    protected string $tableName = 'table';

    /**
     * @var \null[][]
     */
    protected $queryString = [
        'filters' => ['except' => null],
        'sorts' => ['except' => null],
    ];

    /**
     * @var string[]
     */
    protected $listeners = ['refreshDatatable' => '$refresh'];

    /**
     * The array defining the columns of the table.
     *
     * @return array
     */
    abstract public function columns(): array;

    /**
     * The base query with search and filters for the table.
     *
     * @return Builder
     */
    abstract public function query(): Builder;

    /**
     * TableComponent constructor.
     *
     * @param null $id
     */
    public function __construct($id = null)
    {
        parent::__construct($id);

        $theme = config('livewire-tables.theme');

        if ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') {
            $this->paginationTheme = 'bootstrap';
        }

        $this->filters = array_merge($this->filters, $this->baseFilters);
    }

    /**
     * Get the rows query builder with sorting applied.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $this->cleanFilters();

        return $this->applySorting($this->query());
    }

    /**
     * Get the rows paginated collection that will be returned to the view.
     *
     * @return LengthAwarePaginator
     */
    public function getRowsProperty(): LengthAwarePaginator
    {
        return $this->applyPagination($this->rowsQuery);
    }

    /**
     * The view to render each row of the table.
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'livewire-tables::'.config('livewire-tables.theme').'.components.table.row-columns';
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
            ]);
    }
}
