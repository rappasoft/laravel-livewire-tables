---
title: Conditional columns
weight: 5
---

If you would like to show/hide columns based on a conditional, you may use the `hideIf` method on the Column builder:

```php
Column::make('Special Field')
    ->hideIf(! auth()->user()->isAdmin());
```

**Note:** This only works for the corresponding cells if using the column builder to also build the rest of the table.

## When using 'rowView' to render your cells:

Since rowView does not keep track of the column loop, you must also wrap the same conditional around the cells when using this method:

```html
@if (! auth()->user()->isAdmin())
    <x-livewire-tables::table.cell>
        {{ $row->special_field ?? 'N/A' }}
    </x-livewire-tables::table.cell>
@endif
```
