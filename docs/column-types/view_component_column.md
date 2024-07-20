---
title: View Component Columns
weight: 14
---

View Component columns let you specify a component name and attributes and provide attributes to the View Component.  This will render the View Component in it's entirety.

```php

ViewComponentColumn::make('E-mail', 'email')
    ->component('email')
    ->attributes(fn ($value, $row, Column $column) => [
        'id' => $row->id,
        'email' => $value,
    ]),
```

Please also see the following for other available methods:
<ul>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods">Available Methods</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection">Column Selection</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header">Secondary Header</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer">Footer</a>
    </li>
</ul>