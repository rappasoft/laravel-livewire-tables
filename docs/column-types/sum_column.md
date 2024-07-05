---
title: Sum Columns (beta)
weight: 12
---

Sum columns provide an easy way to display the "Sum" of a field on a relation.

```
    SumColumn::make('Total Age of Related Users')
        ->setDataSource('users','age')
        ->sortable(),
```

The "sortable()" callback can accept a callback, or you can use the default behaviour, which calculates the correct field to sort on.