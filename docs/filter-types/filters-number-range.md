---
title: NumberRange Filters
weight: 7
---

NumberRange filters allow for a minimum and maximum value to be input on a single slider.

```php
public function filters(): array
{
    return [
        NumberRangeFilter::make('Success Rate')
            ->options(
                [
                    'min' => 0,
                    'max' => 100,
                ]
            )
            ->config([
                'minRange' => 0,
                'maxRange' => 100,
                'suffix' => '%',
            ])
            ->filter(function (Builder $builder, array $values) {
                $builder->where('users.success_rate', '>=', intval($values['min']))
                ->where('users.success_rate', '<=', intval($values['max']));
            }),

    ];
}
```

The default values should be set in the options() method.

You may also specify a minimum and maximum range in the config() options, and should you wish to use real values instead of a percentage, you can change the "suffix" to a metric of your choosing.
