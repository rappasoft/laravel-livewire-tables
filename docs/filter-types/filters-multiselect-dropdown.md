---
title: Multi-Select Dropdown Filters
weight: 5
---


## Multi-select dropdown Filters

Multi-select dropdown filters are a simple dropdown list. The user can select multiple options from the list. There is also an 'All' option that will select all values

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;

public function filters(): array
{
    return [
        MultiSelectDropdownFilter::make('Tags')
            ->options(
                Tag::query()
                    ->orderBy('name')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->name)
                    ->toArray()
            )
            ->setFirstOption('All Tags'),
    ];
}
```
