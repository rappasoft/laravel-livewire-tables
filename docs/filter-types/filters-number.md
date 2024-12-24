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
            ->filter(function(Builder $builder, string $value) {
                $builder->where('amount', '<', $value);
            }),
    ];
}
```

Historically, min/max/placeholders were set using the "config" option, which is still available.  However, it is strongly recommended to use the new setInputAttributes for enhanced customisation.

## Old Behaviour
The following would:
- Set a min of 0
- Set a max of 100
- Add a placeholder
- Keep the default colors & styling

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

## New Behaviour
The following would:
- Set a min of 5
- Set a max of 20
- Set steps to be 0.5
- Add a placeholder
- Keep the default colors & styling

```php
public function filters(): array
{
    return [
        NumberFilter::make('Age')
        ->setInputAttributes([
            'min' => '5', // Minimum Value Accepted
            'max' => '20', // Maximum Value Accepted
            'step' => '0.5', // Set step
            'placeholder' => 'Enter Number 0 - 100', // A placeholder value
            'default-colors' => true,
            'default-styling' => true,
        ]),
    ];
}
```