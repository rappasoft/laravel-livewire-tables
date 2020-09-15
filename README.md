# A dynamic table component for Laravel Livewire

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rappasoft/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/rappasoft/laravel-livewire-tables)
[![StyleCI](https://styleci.io/repos/250246992/shield?style=plastic)](https://github.styleci.io/repos/250246992)
[![Total Downloads](https://img.shields.io/packagist/dt/rappasoft/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/rappasoft/laravel-livewire-tables)

**This package is still in development and does not have a test suite.**

A dynamic Laravel Livewire component for data tables.

This plugin assumes you already have [Laravel Livewire](https://laravel-livewire.com/) installed and configured in your project.

## Installation

You can install the package via composer:

``` bash
composer require rappasoft/laravel-livewire-tables
```

## Publishing Assets

Publishing assets are optional unless you want to customize this package.

``` bash
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=config

php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=views

php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=lang
```

## Usage

### Creating Tables

To create a table component you draw inspiration from the below stub:

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends TableComponent
{
    use HtmlComponents;

    public function query() : Builder
    {
        return User::with('role')->withCount('permissions');
    }

    public function columns() : array
    {
        return [
            Column::make('ID')
                ->searchable()
                ->sortable(),
            Column::make('Avatar')
                ->format(function(User $model) {
                    return $this->image($model->avatar, $model->name, ['class' => 'img-fluid']);
                }),
            Column::make('Name')
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable()
                ->format(function(User $model) {
                    return $this->mailto($model->email, null, ['target' => '_blank']);
                }),
            Column::make('Role', 'role.name')
                ->searchable()
                ->sortable(),
            Column::make('Permissions')
                ->sortable()
                ->format(function(User $model) {
                    return $this->html('<strong>'.$model->permissions_count.'</strong>');
                }),
            Column::make('Actions')
                ->format(function(User $model) {
                    return view('backend.auth.user.includes.actions', ['user' => $model]);
                })
                ->hideIf(auth()->user()->cannot('do-this')),
        ];
    }
}
```

Your component must implement two methods:

```php
/**
 * This defines the start of the query, usually Model::query() but can also eager load relationships and counts if needed.
 */
public function query() : Builder;

/**
 * This defines the columns of the table, they don't necessarily have to map to columns on the database table.
 */
public function columns() : array;
```

### Rendering the Table

Place the following where you want the table to appear.

Laravel 6.x: 

`@livewire('users-table')`

Laravel 7.x|8.x:

`<livewire:users-table />`

### Defining Columns

You can define the columns of your table with the column class.

The following methods are available to chain to a column:

```php
/**
 * Used to format the column data in different ways, see the HTML Components section.
 * You will be passed the current model and column (if you need it for some reason) which can be omitted as an argument if you don't need it.
 */
public function format(Model $model, Column $column) : self;

/**
 * This column is searchable, with no callback it will search the column by name or by the supplied relationship, using a callback overrides the default searching functionality.
 */
public function searchable(callable $callable = null) : self;

/**
 * This column is sortable, with no callback it will sort the column by name and sort order defined on the components $sortDirection variable
 */
public function sortable(callable $callable = null) : self;

/**
 * The columns output will be put through {!! !!} instead of {{ }}.
 */
public function raw() : self;

/**
 * Hide this column permanently
 */
public function hide() : self;

/**
 * Hide this column based on a condition. i.e.: user has or doesn't have a role or permission. Must return a boolean, not a closure.
 */
public function hideIf($condition) : self;
```

### Properties

You can override any of these in your table component:

#### Table

| Property | Default | Usage |
| -------- | ------- | ----- |
| $tableHeaderEnabled | true | Whether or not to display the table header |
| $tableFooterEnabled | false | Whether or not to display the table footer |

#### Searching

| Property | Default | Usage |
| -------- | ------- | ----- |
| $searchEnabled | true | Whether or not searching is enabled |
| $searchUpdateMethod | debounce | debounce or lazy |
| $searchDebounce | 350 | Amount of time in ms to wait to send the search query and refresh the table |
| $disableSearchOnLoading | false | Whether or not to disable the search bar when it is searching/loading new data | 
| $search | *none* | The initial search string |
| $clearSearchButton | false | Adds a clear button to the search input |
| $clearSearchButtonClass | btn btn-outline-dark | The class applied to the clear button |

#### Sorting

| Property | Default | Usage |
| -------- | ------- | ----- |
| $sortField | id | The initial field to be sorting by |
| $sortDirection | asc | The initial direction to sort |
| $sortDefaultIcon | <i class="text-muted fas fa-sort"></i> | The default sort icon |
| $ascSortIcon | <i class="fas fa-sort-up"></i> | The sort icon when currently sorting ascending |
| $descSortIcon | <i class="fas fa-sort-down"></i> | The sort icon when currently sorting descending |

#### Pagination

| Property | Default | Usage |
| -------- | ------- | ----- |
| $paginationEnabled | true | Enables or disables pagination as a whole |
| $perPageOptions | [10, 25, 50] | The options to limit the amount of results per page. Set to [] to disable. |
| $perPage | 25 | Amount of items to show per page |

#### Loading

| Property | Default | Usage |
| -------- | ------- | ----- |
| $loadingIndicator | false | Whether or not to show a loading indicator when searching |
| $disableSearchOnLoading | false | Whether or not to disable the search bar when it is searching/loading new data |
| $collapseDataOnLoading | false | When the table is loading, hide all data but the loading row |

#### Offline

| Property | Default | Usage |
| -------- | ------- | ----- |
| $offlineIndicator | true | Whether or not to display an offline message when there is no connection |

#### Other

| Property | Default | Usage |
| -------- | ------- | ----- |
| $refresh | false | Whether or not to refresh the table at a certain interval. false = off, int = ms, string = functionCall |

### Table Methods

#### Columns/Data

Use the following methods to alter the column/row metadata.

```php
    public function setTableHeadClass($attribute): ?string
    public function setTableHeadId($attribute): ?string
    public function setTableHeadAttributes($attribute): array
    public function setTableRowClass($model): ?string
    public function setTableRowId($model): ?string
    public function setTableRowAttributes($model): array
    public function getTableRowUrl($model): ?string
    public function setTableDataClass($attribute, $value): ?string
    public function setTableDataId($attribute, $value): ?string
    public function setTableDataAttributes($attribute, $value): array
```

#### Pagination

Override these methods if you want to perform extra tasks when the search or per page attributes change.

```php
public function updatingSearch(): void
public function updatingPerPage(): void
```

#### Search

Override this method if you want to perform extra steps when the search has been cleared.

```php
public function clearSearch(): void
```

#### Sorting

Override this method if you want to change the default sorting behavior.

```php
public function sort($attribute): void
```

### HTML Components

This package includes some of the functionality from the laravelcollective/html package modified to fit the needs of this package.

To use these you must import the *Rappasoft\LaravelLivewireTables\Traits\HtmlComponents* trait.

You may return any of these functions from the format() method of a column:

```php
public function image($url, $alt = null, $attributes = [], $secure = null): HtmlString
public function link($url, $title = null, $attributes = [], $secure = null, $escape = true): HtmlString
public function secureLink($url, $title = null, $attributes = [], $escape = true): HtmlString
public function linkAsset($url, $title = null, $attributes = [], $secure = null, $escape = true): HtmlString
public function linkSecureAsset($url, $title = null, $attributes = [], $escape = true): HtmlString
public function linkRoute($name, $title = null, $parameters = [], $attributes = [], $secure = null, $escape = true): HtmlString
public function linkAction($action, $title = null, $parameters = [], $attributes = [], $secure = null, $escape = true): HtmlString
public function mailto($email, $title = null, $attributes = [], $escape = true): HtmlString
public function email($email): string
public function html($html): HtmlString
```

### Passing Properties

To pass properties from your blade view to your table, you can use the normal Livewire mount method:

```php
<livewire:users-table status="{{ request('status') }}" />
```

```php
protected $status = 'active';

public function mount($status) {
    $this->status = $status;
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email rappa819@gmail.com instead of using the issue tracker.

## Credits

- [Anthony Rappa](https://github.com/rappasoft)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
