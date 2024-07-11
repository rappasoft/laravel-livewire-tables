---
title: Count Columns (beta)
weight: 8
---

Count columns provide an easy way to display the "Count" of a relation.

```
    CountColumn::make('Related Users')
        ->setDataSource('users')
        ->sortable(),
```

The "sortable()" callback can accept a callback, or you can use the default behaviour, which calculates the correct field to sort on.