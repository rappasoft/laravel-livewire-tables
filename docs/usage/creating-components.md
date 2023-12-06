---
title: Creating Components
weight: 1
---

### In-Line Component
You can create components by using the [command](../start/commands) or copying from one of the [examples](../examples/basic-example).

This is what a bare bones component looks like before your customization:

```php
<?php

namespace App\Livewire;

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

### Full Page Component
To use a Table as a Full Page Component, there are a few options that you must set in your configure() method.

#### setLayout
To use a Custom Layout (as a Full Page Component), use the setLayout() method, which expects to be passed a string which is the path to the layout.
```php
    public function configure(): void
    {
        $this->setLayout('path-to-layout');
    }

```

#### setSlot
To use a Custom Slot (as a Full Page Component), use setSlot() method, which expects to be passed a string which is the name of the slot.
```php
    public function configure(): void
    {
        $this->setSlot('slot-name-here');
    }

```

#### setSection
To use a Custom Section (as a Full Page Component), use setSection() method, which expects to be passed a string which is the name of the section.


#### Full Page Component Example
```php
<?php

namespace App\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setLayout('path-to-layout')
            ->setSlot('slot-name-here');
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
