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

## Usage

### Creating Tables

To create a table component you can start with the below stub:

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\TableComponent;

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

```php
/**
 * This defines the start of the query, usually Model::query() but can also eagar load relationships and counts.
 */
public function query() : Builder;

/**
 * This defines the columns of the table, they don't necessarily have to map to columns on the table.
 */
public function columns() : array;
```

### Rendering the Table

Place the following where you want the table to appear.

Laravel 6.x: 

`@livewire('users-table')`

Laravel 7.x:

`<livewire:users-table />`

Obviously replace *users-table* with your component name.

### Defining Columns

You can define the columns of your table with the column class:

```php
Column::make('Name', 'column_name')
```

The first parameter is the name of the table header. The second parameter is the name of the table column. You can leave blank and the lowercase snake_case version will be used by default.

### The column methods you can chain to build your columns:


Make a column **searchable**, with no callback it will search the column by name or by the supplied relationship, using a callback overrides the default searching functionality.

```php
public function searchable(callable $callable = null) : self;
```


Make a column **sortable**, with no callback it will sort the column by name and sort order defined on the components $sortDirection variable
```php
public function sortable(callable $callable = null) : self;
```

Render the column with **{!! !!}** instead of **{{ }}**.
```php
public function unescaped() : self;
```


The columns output will be put through the Laravel **HtmlString** class.
```php
public function html() : self;
```

Set the column to use a **models attribute** instead of a database column name. Useful for custom attributes like `$model->full_name` - `getFullNameAttribute()`:
 
```php
Column::make('Full Name', 'full_name')->customAttribute()

public function customAttribute() : self;
```
 
Use the third `$key` paramater to retreive a value from a **json** column with flat key/value pairs, **or** a models **array** attribute.

```php
Column::make('Published on map', 'settings', 'show_on_map')
   ->jsonKeyVal(),
```


Use a **custom a view** to render the column, can still be used with sortable and searchable.
```php
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

Set a **class** on a **table header** based on the column attribute
```php
public function setTableHeadClass($attribute) : ?string;
```

Set an **ID** on a **table header** based on the column attribute
```php
public function setTableHeadId($attribute) : ?string;
```

Set any **attributes** on a **table header** based on the column attribute

`['name' => 'my-custom-name', 'data-key' => 'my-custom-key']`
```php
public function setTableHeadAttributes($attribute) : array;
```

Used to set a **class** on a **table row**. You have the entre model of the row to work with.
```php
public function setTableRowClass($model) : ?string;
```

Set a **ID** on a **table row**. You have the entre model of the row to work with
```php
public function setTableRowId($model) : ?string;
```

Set any **attribute** on a **table row**. You have the entre model of the row to work with.

`['name' => 'my-custom-name', 'data-key' => 'my-custom-key']`
```php
public function setTableRowAttributes($model) : array;
```

Set the **class** of a **table cell** based on the column and the value of the cell
```php
public function setTableDataClass($attribute, $value) : ?string;
```

Set the **ID** of a **table cell** based on the column and the value of the cell
```php
public function setTableDataId($attribute, $value) : ?string;
```

Set any **attributes** of a **table cell** based on the column and the value of the cell

`['name' => 'my-custom-name', 'data-key' => 'my-custom-key']`

```php
public function setTableDataAttributes($attribute, $value) : array;
```

### Components

Along with being able to provide a view to a column, you can use pre-defined components that are built into the package. These are good for when you want to add actions to a column.

**Note:** By design using the `components()` method on a column will disable all other functionality (i.e. searching/sorting etc.).

#### Defining Components for a Column

```php
Column::make('Actions')
    ->components([
        Link::make('Edit'),
        Link::make('Delete'),
    ])
```

or

```php
Column::make('Actions')
    ->addComponent(Link::make('Edit'))
    ->addComponent(Link::make('Delete'))
```

If you would like to hide all the components for a given row, you may pass a callback as the second parameter of the `components()` method:

```php
Column::make('Actions')
    ->components([
        Link::make('Edit'),
        Link::make('Delete'),
    ], function($model) {
        // Hide the actions for model id 1
        return $model->id === 1;
    })
```

**Note:** You should still assert on the backend that these functions can not be performed on this entity.

Building on that, if you would like to pass a custom message to that column when hiding the components for this row, you may pass another callback as the third parameter:

```php
Column::make('Actions')
    ->components([
        Link::make('Edit'),
        Link::make('Delete'),
    ], function($model) {
        // Hide the actions for model id 1
        return $model->id === 1;
    }, function($model) {
        return __('You can not alter role ' . $model->name . '.');
    })
```

#### Methods

Of course two links that don't do anything would be useless, here are a list of methods to be used for the built in components.

#### Inherited by all components
| Method | Usage |
| -------- | ----- |
| setAttribute($attribute, $value) | Set an attribute on the component |
| setAttributes(array $attributes = []) | Set multiple attributes at once |
| getAttributes() | Get the array of available attributes |
| setOption($option, $value) | Set an option on the component |
| setOptions(array $options = []) | Set multiple options at once |
| getOptions() | Get the array of available options |
| hideIf($condition) | Hide this component if true |
| hide() | Hide this component forever |
| isHidden() | This component is currently hidden |

By default all components have access to the `$attributes` and `$options` arrays.

#### Link Component

| Method | Usage | Type |
| -------- | ----- | ---- |
| text($text) | Set the text of the link | string/false |
| class($class) | Set the html class on the link | string |
| id($id) | Set the id of the link | string |
| icon($icon) | Set the icon of the link (font awesome) | string |
| href(function($model){}) | Set the href of the link | string/callback |
| view($view) | The view to render for the component | string |

#### Button Component

| Method | Usage | Type |
| -------- | ----- | ---- |
| text($text) | Set the text of the button | string/false |
| class($class) | Set the html class on the button | string |
| id($id) | Set the id of the button | string |
| icon($icon) | Set the icon of the button (font awesome) | string |
| view($view) | The view to render for the component | string |

#### Boolean Component
You define `text`, `column`, and optional `key` when you define the boolean component.

| Method | Usage | Type |
| -------- | ----- | ---- |
| class($class) | Optional class on the surrounding span tag | string |
| id($id) | Optional the id of the surrounding span tag | string |
| icon([..]) | Optional true/false icon and color (font awesome) | array |
| view($view) | The view to render for the component | string |

| Attributes | Usage | Type |
| -------- | ----- | ---- |
| $label | Optional label to display in the table cell | string |
| $column | Required, name of the table column | string |
| $key  | Optional parameter used with a json column or a models array attribute `$model->column[$key]` You must `$cast` the column to array on the model | array |

##### The default values for the Boolean `icon` component
You do not have to specify any values for the icon. The component falls back to these settings. But many times a truthy value is considered negative and vice versa, you can therefor defin any icon and color you wish.
```php
->icon([
   'true' => 'fas fa-toggle-on',
   'false' => 'fas fa-toggle-off',
   'true-class' => 'text-success',
   'false-class' => 'text-danger'
 ])
```


##### Boolean component example from a standard database tinyint column.
```php
Boolean::make($label, $column)->icon([...])
```

```php

Column::make('Published', 'published')
                ->sortable()
                ->components([
                    Boolean::make( null, 'published')
                    ->icon([
                        'true' => 'fas fa-eye',
                        'false' => 'fas fa-eye-slash',
                        'true-class' => 'text-aurora-green',
                        'false-class' => 'text-aurora-red'
                    ])
                    ->class('bg-white')
                ]),
```

##### Boolean component example from a `json` column (or models `array attribute`) with flat key/value pairs.
Remember to `cast` the json column to array on the model.
```php
Boolean::make($label, $column, $key)->icon([...])
```

```php
Column::make('Hide in guide', 'settings')
                ->components([
                    Boolean::make(null, 'settings', 'hide_in_guide')
                        ->jsonKeyVal()
                ]),
```


```php

Column::make('Published', 'published')
                ->sortable()
                ->components([
                    Boolean::make( null, 'published')
                    ->icon([
                        'true' => 'fas fa-eye',
                        'false' => 'fas fa-eye-slash',
                        'true-class' => 'text-aurora-green',
                        'false-class' => 'text-aurora-red'
                    ])
                    ->class('bg-white')
                ]),
```


#### Example

This example comes from the upcoming release of my popular [Laravel Boilerplate Project](http://laravel-boilerplate.com). Here we render the roles table in the admin panel.

This example uses searching, sorting, relationships, custom attributes, counted relationships, and components:

```php
public function columns() : array {
    return [
        Column::make('Name')
            ->searchable()
            ->sortable(),
        Column::make('Permissions', 'permissions_label')
            ->customAttribute()
            ->html()
            ->searchable(function($builder, $term) {
                return $builder->orWhereHas('permissions', function($query) use($term) {
                   return $query->where('name', 'like', '%'.$term.'%');
                });
            }),
        Column::make('Number of Users', 'users_count')
            ->sortable(),
        Column::make('Actions')
            ->components([
                Link::make('Edit') // Optionally pass false to hide the text
                    ->icon('fas fa-pencil-alt')
                    ->class('btn btn-primary btn-sm')
                    ->href(function($model) {
                        return route('admin.auth.role.edit', $model->id);
                    })
                    ->hideIf(auth()->user()->cannot('access.roles.edit')),
                Link::make('Delete')
                    ->icon('fas fa-trash')
                    ->class('btn btn-danger btn-sm')
                    ->setAttribute('data-method', 'delete') // Javascript takes over and injects a hidden form
                    ->href(function($model) {
                        return route('admin.auth.role.destroy', $model->id);
                    })
                    ->hideIf(auth()->user()->cannot('access.roles.delete')),
            ], function($model) {
                // Hide components for this row if..
                return $model->id === config('access.roles.admin');
            }),
    ];
}
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
