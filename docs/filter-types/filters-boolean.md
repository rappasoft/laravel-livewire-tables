---
title: Boolean Filters (beta)
weight: 2
---

## Beta
This is currently in beta, and will only work with Tailwind.

## Details

The BooleanFilter is designed so that you can toggle a more complex query/filter, as opposed to being a yes/no type of filter (which is what the SelectFilter is perfect for)

For example, your filter may look like this, toggling the filter from true to false would apply/not apply a more complex query to the query.

```php
    BooleanFilter::make('Limit to Older Enabled Users')
    ->filter(function (Builder $builder, bool $enabled) {
        if ($enabled)
        {
            $builder->where('status',true)->where('age', '>', 60);
        }
    })
```
