---
title: Array Columns (beta)
weight: 1
---

Array columns provide an easy way to work with and display an array of data from a field.

```
    ArrayColumn::make('notes', 'name')
    ->data(fn($value, $row) => ($row->notes))
    ->outputFormat(fn($index, $value) => "<a href='".$value->id."'>".$value->name."</a>")
    ->separator('<br />')
    ->sortable(),
```