---
title: Button Group Columns
weight: 5
---

Button group columns let you provide an array of LinkColumns to display in a single cell.

```php
ButtonGroupColumn::make('Actions')
    ->attributes(function($row) {
        return [
            'class' => 'space-x-2',
        ];
    })
    ->buttons([
        LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
            ->title(fn($row) => 'View ' . $row->name)
            ->location(fn($row) => route('user.show', $row))
            ->attributes(function($row) {
                return [
                    'class' => 'underline text-blue-500 hover:no-underline',
                ];
            }),
        LinkColumn::make('Edit')
            ->title(fn($row) => 'Edit ' . $row->name)
            ->location(fn($row) => route('user.edit', $row))
            ->attributes(function($row) {
                return [
                    'target' => '_blank',
                    'class' => 'underline text-blue-500 hover:no-underline',
                ];
            }),
    ]),
```
