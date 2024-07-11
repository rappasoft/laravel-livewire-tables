---
title: Component Columns
weight: 7
---

Component columns let you specify a component name and attributes and provides the column value to the slot.

```php
// Before
Column::make("Email", "email")
    ->format(function ($value) {
        return view('components.alert')
            ->with('attributes', new ComponentAttributeBag([
                'type' => Str::endsWith($value, 'example.org') ? 'success' : 'danger',
                'dismissible' => true,
            ]))
            ->with('slot', $value);
    }),

// After
ComponentColumn::make('E-mail', 'email')
    ->component('email')
    ->attributes(fn ($value, $row, Column $column) => [
        'type' => Str::endsWith($value, 'example.org') ? 'success' : 'danger',
        'dismissible' => true,
    ]),
```


Please also see the following for other available methods:
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods](Available Methods)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection](Column Selection)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header](Secondary Header)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer](Footer)
