---
title: Number Filters
weight: 6
---

## Number Filters

Number filters are just HTML number inputs.

```php
public function filters(): array
{
    return [
        NumberFilter::make('Amount')
            ->config([
                'min' => 0,
                'max' => 100,
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->where('amount', '<', $value);
            }),
    ];
}
```
