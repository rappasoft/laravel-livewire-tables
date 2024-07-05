---
title: Avg Columns (beta)
weight: 2
---

Avg columns provide an easy way to display the "Average" of a field on a relation.

```
    AvgColumn::make('Average Related User Age')
        ->setDataSource('users','age')
        ->sortable(),
```

The "sortable()" callback can accept a callback, or you can use the default behaviour, which calculates the correct field to sort on.