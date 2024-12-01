---
title: Livewire Component (beta)
weight: 14
---

Livewire Component Columns allow for the use of a Livewire Component as a Column.

This is **not recommended** as due to the nature of Livewire, it becomes inefficient at scale.

## component
```
LivewireComponentColumn::make('Action')
    ->component('PathToLivewireComponent'),

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
