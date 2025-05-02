---
title: Array Columns (beta)
weight: 2
---

Array columns provide an easy way to work with and display an array of data from a field.

```php
ArrayColumn::make('notes', 'name')
    ->data(fn($value, $row) => ($row->notes))
    ->outputFormat(fn($index, $value) => "<a href='".$value->id."'>".$value->name."</a>")
    ->separator('<br />')
    ->sortable(),
```

## Empty Value
You may define the default/empty value using the "emptyValue" method

```php
ArrayColumn::make('notes', 'name')
    ->emptyValue('Unknown'),
```

## Wrapping the Output

As the ArrayColumn is designed to handle multiple related records, you can choose to wrap these for improved UX.

It is recommended that you utilise the built-in flexCol or flexRow approaches, which will also disable the separator

### flexCol
This adds either:
- Tailwind: 'flex flex-col'
- Bootstrap: 'd-flex d-flex-col'

And merges any attributes specified in the sole parameter (as an array)
```php
ArrayColumn::make('notes', 'name')
    ->data(fn($value, $row) => ($row->notes))
    ->outputFormat(fn($index, $value) => "<a href='".$value->id."'>".$value->name."</a>")
    ->flexCol(['class' => 'bg-red-500'])
    ->sortable(),
```

### flexRow

This adds either:
- Tailwind: 'flex flex-row'
- Bootstrap: 'd-flex d-flex-row'

And merges any attributes specified in the sole parameter (as an array)
```php
ArrayColumn::make('notes', 'name')
    ->data(fn($value, $row) => ($row->notes))
    ->outputFormat(fn($index, $value) => "<a href='".$value->id."'>".$value->name."</a>")
    ->flexRow(['class' => 'bg-red-500'])
    ->sortable(),
```

### Manually

You can also specify a wrapperStart and wrapperEnd, for example, for an unordered list:

```php
ArrayColumn::make('notes', 'name')
    ->data(fn($value, $row) => ($row->notes))
    ->outputFormat(fn($index, $value) => "<li><a href='".$value->id."'>".$value->name."</a></li>")
    ->wrapperStart("<ul class='bg-blue'>")
    ->wrapperEnd("</ul>")
    ->sortable(),
```

## See Also

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