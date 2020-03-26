<?php

namespace Rappasoft\LivewireTables\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LivewireTables\Http\Livewire\Traits\Yajra;

/**
 * Class TableComponent
 *
 * @package App\Http\Livewire
 */
abstract class TableComponent extends Component
{

    use WithPagination, Yajra;

    /**
     * Pagination
     */

    /**
     * Displays per page and pagination links
     *
     * @var bool
     */
    public $paginationEnabled = true;

    /**
     * The options to limit the amount of results per page
     *
     * @var array
     */
    public $perPageOptions = [10, 25, 50];

    /**
     * Amount of items to show per page
     *
     * @var int
     */
    public $perPage = 25;

    /**
     * The label for the per page filter
     *
     * @var string
     */
    public $perPageLabel;

    /**
     * -------------------------------------------------
     */

    /**
     * Search
     */

    /**
     * Whether or not searching is enabled
     *
     * @var bool
     */
    public $searchEnabled = true;

    /**
     * false = disabled
     * int = Amount of time in ms to wait to send the search query and refresh the table
     *
     * @var int
     */
    public $searchDebounce = 350;

    /**
     * Whether or not to disable the search bar when it is searching/loading new data
     *
     * @var bool
     */
    public $disableSearchOnLoading = true;

    /**
     * The initial search string
     *
     * @var string
     */
    public $search = '';

    /**
     * The placeholder for the search box
     *
     * @var string
     */
    public $searchLabel;

    /**
     * The message to display when there are no results
     *
     * @var string
     */
    public $noResultsMessage;

    /**
     * -------------------------------------------------
     */

    /**
     * Sorting
     */

    /**
     * The initial field to be sorting by
     *
     * @var string
     */
    public $sortField = 'id';

    /**
     * The initial direction to sort
     *
     * @var bool
     */
    public $sortDirection = 'asc';

    /**
     * -------------------------------------------------
     */

    /**
     * Loading
     */

    /**
     * @var bool Whether or not to show a loading indicator when searching
     */
    public $loadingIndicator = false;

    /**
     * @var string The loading message that gets displayed
     */
    public $loadingMessage;

    /**
     * -------------------------------------------------
     */

    /**
     * Offline
     */

    /**
     * @var bool Whether or not to display an offline message when there is no connection
     */
    public $offlineIndicator = true;

    /**
     * The message to display when offline
     *
     * @var string
     */
    public $offlineMessage;

    /**
     * -------------------------------------------------
     */

    /**
     * Table
     */

    /**
     * The class to set on the table
     *
     * @var string
     */
    public $tableClass = 'table table-striped';

    /**
     * Whether or not to display the table header
     *
     * @var bool
     */
    public $tableHeaderEnabled = true;

    /**
     * The class to set on the thead of the table
     *
     * @var string
     */
    public $tableHeaderClass = '';

    /**
     * Whether or not to display the table footer
     *
     * @var bool
     */
    public $tableFooterEnabled = false;

    /**
     * The class to set on the tfoot of the table
     *
     * @var string
     */
    public $tableFooterClass = '';

    /**
     * false is off
     * string is the tables wrapping div class
     *
     * @var bool
     */
    public $responsive = 'table-responsive';

    /**
     * -------------------------------------------------
     */

    /**
     * Checboxes
     */

    /**
     * Whether or not checkboxes are enabled
     *
     * @var bool
     */
    public $checkbox = true;

    /**
     * The side to put the checkboxes on
     *
     * @var string
     */
    public $checkboxLocation = 'left';

    /**
     * The model attribute to bind to the checkbox array
     *
     * @var string
     */
    public $checkboxAttribute = 'id';

    /**
     * Whether or not all checkboxes are currently selected
     *
     * @var bool
     */
    public $checkboxAll = false;

    /**
     * The currently selected values of the checkboxes
     *
     * @var array
     */
    public $checkboxValues = [];

    /**
     * -------------------------------------------------
     */

    /**
     * Other
     */

    /**
     * Whether or not to refresh the table at a certain interval
     * false is off
     * If it's an integer it will be treated as milliseconds (2000 = refresh every 2 seconds)
     * If it's a string it will call that function every 5 seconds
     *
     * @var bool|string
     */
    public $refresh = false;

    /**
     * The classes applied to the wrapper div
     *
     * @var string
     */
    public $wrapperClass = '';

    /**
     * Constructor
     */
    public function mount() {
        $this->setTranslationStrings();
    }

    /**
     * Sets the initial translations of these items
     */
    public function setTranslationStrings() {
        $this->loadingMessage = __('Loading...');
        $this->offlineMessage = __('You are not currently connected to the internet.');
        $this->noResultsMessage = __('There are no results to display for this query.');
        $this->perPageLabel = __('Per Page');
        $this->searchLabel = __('Search...');
    }

    /**
     * @return mixed
     */
    abstract public function query() : Builder;

    /**
     * @return mixed
     */
    abstract public function columns() : array ;

    /**
     * @return string
     */
    public function view() : string {
        return 'laravel-livewire-tables::table';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render() : View
    {
        return view($this->view(), [
            'columns' => $this->columns(),
            'models' => $this->paginationEnabled ? $this->models()->paginate($this->perPage) : $this->models()->get(),
        ]);
    }

    /**
     * @return Builder
     */
    public function models() : Builder
    {
        $models = $this->query();

        if ($this->searchEnabled && $this->search) {
            $models->where(function (Builder $query) {
                foreach ($this->columns() as $column) {
                    if ($column->searchable) {
                        if (is_callable($column->searchCallback)) {
                            $query = app()->call($column->searchCallback, ['builder' => $query, 'term' => $this->search]);
                        } else {
                            if (Str::contains($column->attribute, '.')) {
                                $relationship = $this->relationship($column->attribute);

                                $query->orWhereHas($relationship->name, function (Builder $query) use ($relationship) {
                                    $query->where($relationship->attribute, 'like', '%' . $this->search . '%');
                                });
                            } else {
                                $query->orWhere($query->getModel()->getTable() . '.' . $column->attribute, 'like', '%' . $this->search . '%');
                            }
                        }
                    }
                }
            });
        }

        if (Str::contains($this->sortField, '.')) {
            $relationship = $this->relationship($this->sortField);
            $sortField = $this->attribute($models, $relationship->name, $relationship->attribute);
        } else {
            $sortField = $this->sortField;
        }

        if (($column = $this->getColumnByAttribute($this->sortField)) !== null && is_callable($column->sortCallback)) {
            return app()->call($column->sortCallback, ['models' => $models, 'sortField' => $sortField, 'sortDirection' => $this->sortDirection]);
        }

        return $models->orderBy($sortField, $this->sortDirection);
    }

    /**
     * @param $attribute
     */
    public function sort($attribute) : void
    {
        if ($this->sortField !== $attribute) {
            $this->sortDirection = 'asc';
        } else {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }

        $this->sortField = $attribute;
    }

    /**
     * @param $attribute
     *
     * @return |null
     */
    public function thClass($attribute)
    {
        return null;
    }

    /**
     * @param $model
     *
     * @return |null
     */
    public function trClass($model)
    {
        return null;
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return |null
     */
    public function tdClass($attribute, $value)
    {
        return null;
    }

    /**
     *
     */
    public function updatedCheckboxAll()
    {
        $this->checkboxValues = [];

        if ($this->checkboxAll) {
            $this->models()->each(function ($model) {
                $this->checkboxValues[] = (string)$model->{$this->checkboxAttribute};
            });
        }
    }

    /**
     *
     */
    public function updatedCheckboxValues()
    {
        $this->checkboxAll = false;
    }
}
