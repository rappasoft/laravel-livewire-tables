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