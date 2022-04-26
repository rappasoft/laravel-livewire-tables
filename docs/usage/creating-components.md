---
title: Creating Components
weight: 1
---

You can create components by using the [command](../start/commands) or copying from one of the [examples](../examples/basic-example).

This is what a bare bones component looks like before your customization:

```php
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Name')
                ->sortable(),
        ];
    }
}
```

Your component will extend the `Rappasoft\LaravelLivewireTables\DataTableComponent` class and at minimum implement 2 methods called [configure](./configuration) and [columns](../columns/creating-columns).
