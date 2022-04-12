---
title: Applying Filters
weight: 3
---

By default, a filter does nothing. You have to tell it how to process the selected value.

There are two ways to apply filters, at the filter level, and at the component level.

## Apply Filters at the Filter Level

The `filter()` method will allow you to return a callback that will be used to process the selected value. You will get the builder and selected value to work with.

```php
SelectFilter::make('Active')
    ->options([
        '' => 'All',
        '1' => 'Yes',
        '0' => 'No',
    ])
    ->filter(function(Builder $builder, string $value) {
        if ($value === '1') {
            $builder->where('active', true);
        } elseif ($value === '0') {
            $builder->where('active', false);
        }
    }),
```

## Apply Filters at the Component Level

If you don't want to apply at the filter level, you can apply the filter at the component level.

```php
public function builder(): Builder
{
    return User::query();
         ->when($this->getAppliedFilterWithValue('active'), fn($query, $active) => $query->where('active', $active === 'yes'));
}
```

You can use the `getAppliedFilterWithValue()` method to grab the current value of the filter or null if it is not applied.

### A note about integer values

Even if you have your values as strings, but are still using integers, you may have unexpected results when using Eloquent's `when()` method to apply your filters (if going that route).

For example, if you have values of `0 and 1`, the eloquent `when()` method will not execute when the value is '0' as it treats it as false.

So it is better to not use `getAppliedFilterWithValue()` or `integer keys` in the situations where you want to apply the filter in the builder method.
