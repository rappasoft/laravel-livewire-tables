---
title: Number Filters
weight: 9
---

Number filters are just HTML number inputs.

```php
public function filters(): array
{
    return [
        NumberFilter::make('Amount')
            ->config([
                'min' => 0, // Minimum Value Accepted
                'max' => 100, // Maximum Value Accepted
                'placeholder' => 'Enter Number 0 - 100', // A placeholder value
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->where('amount', '<', $value);
            }),
    ];
}
```
