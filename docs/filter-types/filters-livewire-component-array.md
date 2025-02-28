---
title: Livewire Custom Array Filter (Beta)
weight: 13
---

**IN BETA**
This feature is currently in beta, and use in production is not recommended.

### Usage
This allows you to use a child/nested Livewire Component in place of the existing Filters, giving you more control over the look/feel/behaviour of a filter.  This version supports use of returning an array of values for use in filtering.

To use a LivewireComponentArrayFilter, you must include it in your namespace:
```php
use Rappasoft\LaravelLivewireTables\Views\Filters\LivewireComponentArrayFilter;
```

When creating a filter:
- Specify a unique name
- Set the path to a valid Livewire Component
- Define a filter() callback to define how the returned value will be used.

```php
    public function filters(): array
    {
        return [ 
            LivewireComponentArrayFilter::make('My External Filter')
            ->setLivewireComponent('my-test-external-filter')
            ->filter(function (Builder $builder, array $values) {
                $builder->whereIn('foreign_id', $values);
            }),
        ];
    }
```

### setPillsSeparator
As this is an array, you can define the separator to use between pills values, by default this is set to ", "

```php
    public function filters(): array
    {
        return [ 
            LivewireComponentArrayFilter::make('My External Filter')
            ->setLivewireComponent('my-test-external-filter')
            ->setPillsSeparator(' OR ')
            ->filter(function (Builder $builder, array $values) {
                $builder->whereIn('foreign_id', $values);
            }),
        ];
    }
```

