---
title: Sum Columns (beta)
weight: 13
---

Sum columns provide an easy way to display the "Sum" of a field on a relation.

```
    SumColumn::make('Total Age of Related Users')
        ->setDataSource('users','age')
        ->sortable(),
```

The "sortable()" callback can accept a callback, or you can use the default behaviour, which calculates the correct field to sort on.

Please also see the following for other available methods:
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods](Available Methods)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection](Column Selection)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header](Secondary Header)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer](Footer)
