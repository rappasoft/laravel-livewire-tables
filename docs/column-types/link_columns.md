---
title: Link Columns
weight: 11
---

Link columns provide a way to display HTML links in your table without having to use `format()` or partial views:

```php
LinkColumn::make('Action')
    ->title(fn($row) => 'Edit')
    ->location(fn($row) => route('admin.users.edit', $row)),
```

You may also pass an array of attributes to apply to the `a` tag:

```php
LinkColumn::make('Action')
    ->title(fn($row) => 'Edit')
    ->location(fn($row) => route('admin.users.edit', $row))
    ->attributes(fn($row) => [
        'class' => 'rounded-full',
        'alt' => $row->name . ' Avatar',
    ]),
```

Please also see the following for other available methods:
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods](Available Methods)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection](Column Selection)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header](Secondary Header)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer](Footer)
