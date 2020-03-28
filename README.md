# A dynamic table component for Laravel Livewire

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rappasoft/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/rappasoft/laravel-livewire-tables)
[![StyleCI](https://styleci.io/repos/250246992/shield?style=plastic)](https://github.styleci.io/repos/250246992)
[![Total Downloads](https://img.shields.io/packagist/dt/rappasoft/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/rappasoft/laravel-livewire-tables)

**This package is currently in development and the source is constantly changing, use at your own risk.**

A dynamic Laravel Livewire component for data tables.

This plugin assumes you already have [Laravel Livewire](https://laravel-livewire.com/) installed and configured in your project.

## Installation

You can install the package via composer:

``` bash
composer require rappasoft/laravel-livewire-tables
```

## Usage

### Creating Tables

To create a table component you can start with the below stub:

```
<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LivewireTables\Http\Livewire\Column;
use Rappasoft\LivewireTables\Http\Livewire\TableComponent;

class UsersTable extends TableComponent
{

    public function query() : Builder
    {
        return User::with('role')
            ->withCount('permissions');
    }

    public function columns() : array
    {
        return [
            Column::make('ID')
                ->searchable()
                ->sortable(),
            Column::make('Name')
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable(),
            Column::make('Role', 'role.name')
                ->searchable()
                ->sortable(),
            Column::make('Permissions', 'permissions_count')
                ->sortable(),
            Column::make('Actions')
                ->view('backend.auth.user.includes.actions'),
        ];
    }
}

```

Your component must implement two methods:

```
/**
 * This defines the start of the query, usually Model::query() but can also eagar load relationships and counts.
 */
public function query() : Builder;

/**
 * This defines the columns of the table, they don't necessarily have to map to columns on the table.
 */
public function columns() : array;
```

### Rendering the table

Place the following where you want the table to appear.

Laravel 6.x: 

`@livewire('users-table')`

Laravel 7.x:

`<livewire:users-table />`

Obviously replace *users-table* with your component name.

### Defining Columns

You can define the columns of your table with the column class:

```
Column::make('Name', 'column_name')
```

The first parameter is the name of the table header. The second parameter is the name of the table column. You can leave blank and the lowercase snake_case version will be used by default.

Here are a list of the column method you can chain to build your columns:

```
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
public function unescaped() : self;

/**
 * The columns output will be put through the Laravel HtmlString class.
 */
public function html() : self;

/**
 * This column will not look on the table for the column name, it will look on the model for the given attribute. Useful for custom attributes like getFullNameAttribute: Column::make('Full Name', 'full_name')->customAttribute()
 */
public function customAttribute() : self;

/**
 * This view will be used for the column, can still be used with sortable and searchable.
 */
public function view($view) : self;
```

### Properties

You can override any of these in your table component:

#### Table

| Property | Default | Usage |
| -------- | ------- | ----- |
| $tableHeaderEnabled | true | Whether or not to display the table header |
| $tableFooterEnabled | false | Whether or not to display the table footer |
| $tableClass | table table-striped | The class to set on the table |
| $tableHeaderClass | *none* | The class to set on the thead of the table |
| $tableFooterClass | *none* | The class to set on the tfoot of the table |
| $responsive | table-responsive | Tables wrapping div class |

#### Searching

| Property | Default | Usage |
| -------- | ------- | ----- |
| $searchEnabled | true | Whether or not searching is enabled |
| $searchDebounce | 350 | Amount of time in ms to wait to send the search query and refresh the table |
| $disableSearchOnLoading | true | Whether or not to disable the search bar when it is searching/loading new data | 
| $search | *none* | The initial search string |
| $searchLabel | Search... | The placeholder for the search box |
| $noResultsMessage | There are no results to display for this query. | The message to display when there are no results |

#### Sorting

| Property | Default | Usage |
| -------- | ------- | ----- |
| $sortField | id | The initial field to be sorting by |
| $sortDirection | asc | The initial direction to sort |

#### Pagination

| Property | Default | Usage |
| -------- | ------- | ----- |
| $paginationEnabled | true | Displays per page and pagination links |
| $perPageOptions | [10, 25, 50] | The options to limit the amount of results per page |
| $perPage | 25 | Amount of items to show per page |
| $perPageLabel | Per Page | The label for the per page filter |

#### Loading

| Property | Default | Usage |
| -------- | ------- | ----- |
| $loadingIndicator | false | Whether or not to show a loading indicator when searching |
| $loadingMessage | Loading... | The loading message that gets displayed |

#### Offline

| Property | Default | Usage |
| -------- | ------- | ----- |
| $offlineIndicator | true | Whether or not to display an offline message when there is no connection |
| $offlineMessage | You are not currently connected to the internet. | The message to display when offline | 

#### Checkboxes

| Property | Default | Usage |
| -------- | ------- | ----- |
| $checkbox | false | Whether or not checkboxes are enabled |
| $checkboxLocation | left | The side to put the checkboxes on |
| $checkboxAttribute | id | The model attribute to bind to the checkbox array |
| $checkboxAll | false | Whether or not all checkboxes are currently selected |
| $checkboxValues | [] | The currently selected values of the checkboxes |

#### Other

| Property | Default | Usage |
| -------- | ------- | ----- |
| $wrapperClass | *none* | The classes applied to the wrapper div |
| $refresh | false | Whether or not to refresh the table at a certain interval. false = off, If it's an integer it will be treated as milliseconds (2000 = refresh every 2 seconds), If it's a string it will call that function every 5 seconds.

### Table Methods

```
/**
 * Used to set a class on a table header based on the column attribute
 */
public function setTableHeadClass($attribute) : ?string;

/**
 * Used to set a ID on a table header based on the column attribute
 */
public function setTableHeadId($attribute) : ?string;

/**
 * Used to set any attributes on a table header based on the column attribute
 * ['name' => 'my-custom-name', 'data-key' => 'my-custom-key']
 */
public function setTableHeadAttributes($attribute) : array;

/**
 * Used to set a class on a table row
 * You have the entre model of the row to work with
 */
public function setTableRowClass($model) : ?string;

/**
 * Used to set a ID on a table row
 * You have the entre model of the row to work with
 */
public function setTableRowId($model) : ?string;

/**
 * Used to set any attribute on a table row
 * You have the entre model of the row to work with
 * ['name' => 'my-custom-name', 'data-key' => 'my-custom-key']
 */
public function setTableRowAttributes($model) : array;

/**
 * Used to set the class of a table cell based on the column and the value of the cell
 */
public function setTableDataClass($attribute, $value) : ?string;

/**
 * Used to set the ID of a table cell based on the column and the value of the cell
 */
public function setTableDataId($attribute, $value) : ?string;

/**
 * Used to set any attributes of a table cell based on the column and the value of the cell
 * ['name' => 'my-custom-name', 'data-key' => 'my-custom-key']
 */
public function setTableDataAttributes($attribute, $value) : array;
```

## Inspiration From:

- [https://github.com/kdion4891/laravel-livewire-tables](https://github.com/kdion4891/laravel-livewire-tables)
- [https://github.com/yajra/laravel-datatables](https://github.com/yajra/laravel-datatables)

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
