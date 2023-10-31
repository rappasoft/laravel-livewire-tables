---
title: Text Filters
weight: 10
---

## Text Filters

Text filters are just HTML text fields.

```php
public function filters(): array
{
    return [
        TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->where('users.name', 'like', '%'.$value.'%');
            }),
    ];
}
```
