---
title: Array Columns (beta)
weight: 2
---

Array columns provide an easy way to work with and display an array of data from a field.

```
ArrayColumn::make('notes', 'name')
    ->data(fn($value, $row) => ($row->notes))
    ->outputFormat(fn($index, $value) => "<a href='".$value->id."'>".$value->name."</a>")
    ->separator('<br />')
    ->sortable(),
```

### Empty Value
You may define the default/empty value using the "emptyValue" method

```
ArrayColumn::make('notes', 'name')
    ->emptyValue('Unknown'),
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