---
title: Avg Columns (beta)
weight: 3
---

Avg columns provide an easy way to display the "Average" of a field on a relation.

```php
    AvgColumn::make('Average Related User Age')
        ->setDataSource('users','age')
        ->sortable(),
```

The "sortable()" callback can accept a callback, or you can use the default behaviour, which calculates the correct field to sort on.

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