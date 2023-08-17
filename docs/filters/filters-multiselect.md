---
title: Multi-Select Filters
weight: 6
---

## Multi-select Filters

Multi-select filters are a list of checkboxes. The user can select multiple options from the list. There is also an 'All' option that will select all values.

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

public function filters(): array
{
    return [
        MultiSelectFilter::make('Tags')
            ->options(
                Tag::query()
                    ->orderBy('name')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->name)
                    ->toArray()
            ),
    ];
}
```
