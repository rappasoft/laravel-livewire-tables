---
title: Anonymous Columns
weight: 9
---

## Introduction

Sometimes you may need an "anonymous column", or a column that isn't bound to any column in your database. A common
example of this would be an "actions" column at the end of every row with actions of "view", "edit", and/or "delete".
Though, it doesn't have to be an action column, it could be anything.

By using an anonymous column, you take full control by using your own view component. So if you find the LinkColumn, 
ImageColumn, or any of the other columns too restrictive for your needs, then an anonymous column may be what you need.

To make an anonymous column, you create an anonymous function that returns a string or a view into the `label()` method, which will 
remove the requirement for a database column. Thus, making it "anonymous". You can also pass variables to the view by
chaining the `with()` method onto the `view()` method that gets returned by the anonymous function into the `label()`.
So you can either pass specific values, or the whole row itself. 

Lastly, you may chain the `html()` method to the column so it
can render your view component as html.

## Example Column Using a String
Here is an example of using a label to return the "Full Name" of a User.  Note that as we are using a label(), you must add any related fields into the setAdditionalSelects() method in the configure() method.

In this case, we are adding the "forename" and "surname" field from the database to the computed set of selects, then in the label, we are combining those, while capitalising the first letter of each name.  There are of course better methods to achieve this use case, however this is just an example of the functionality.

In your `DataTableComponent`:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setAdditionalSelects(['users.forename as forename', 'users.surname as surname']);
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Full Name')
                ->label(fn ($row, Column $column) => ucwords($row->forename ?? '' . ' ' . $row->surname)),

        ];
    }
}
```

## Example Action Column Using Views

Here is an example of an action column using FontAwesome icons for the "view", "edit", and "delete" actions.

In your `DataTableComponent`:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'asc');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Registered', 'created_at')
                ->sortable(),
            Column::make('Updated', 'updated_at')
                ->sortable(),
            Column::make('Last Login', 'last_login_at')
                ->sortable(),

            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => view('components.livewire.datatables.action-column')->with(
                        [
                            'viewLink' => route('users.view', $row),
                            'editLink' => route('users.edit', $row),
                            'deleteLink' => route('users.delete', $row),
                        ]
                    )
                )->html(),
        ];
    }
}
```

NOTE: You don't have to pass individual properties like `viewLink` and so on. You could simply
pass the whole record to your view and handle it however you need within the view file. Example:

```php
Column::make('Action')
    ->label(
        fn ($row, Column $column) => view('components.livewire.datatables.action-column')->with([
            'user' => $row,
        ])
    )->html(),
```

Now in your component's view file you can do something like this:

```php
<div>
    @isset ( $viewLink )
        <a href="{{ $viewLink }}"><i class="fa-solid fa-eye me-2"></i></a>
    @endif

    @isset ( $editLink )
        <a href="{{ $editLink }}"><i class="fa-solid fa-pen-to-square me-2"></i></a>
    @endif

    @isset ( $deleteLink )
        <form
            action="{{ $deleteLink }}"
            class="d-inline"
            method="POST"
            x-data
            @submit.prevent="if (confirm('Are you sure you want to delete this user?')) $el.submit()"
        >
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-link">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    @endif
</div>
```

Or, if you passed the whole record, you could use:

```php
<a href="{{ route('users.view', $user) }}"><i class="fa-solid fa-eye me-2"></i></a>
```

## Screenshot

The final result can look something like this:

<img width="1104" alt="users-table-action-column" src="https://github.com/rappasoft/laravel-livewire-tables/assets/9557392/b0432731-c882-45bb-8c53-54a3f485f9a3">

