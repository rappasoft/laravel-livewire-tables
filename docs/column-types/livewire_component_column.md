---
title: Livewire Component (beta)
weight: 12
---

Livewire Component Columns allow for the use of a Livewire Component as a Column.

This is **not recommended** as due to the nature of Livewire, it becomes inefficient at scale.

## component
```
LivewireComponentColumn::make('Action')
    ->title(fn($row) => 'Edit')
    ->component('PathToLivewireComponent'),

```

Please also see the following for other available methods:
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods](Available Methods)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection](Column Selection)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header](Secondary Header)
- [https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer](Footer)
