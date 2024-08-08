---
title: Reusable Columns
weight: 8
---

Often you will want to re-use the same column across multiple tables.  For example a "Created At" and "Used At" column.

To mitigate the pain of maintaining this, two new methods have been introduced.

These methods both function in exactly the same way as your standard columns(), and expect an array of columns.

Any columns defined in prependColumns() will be the first columns in your list of columns.
```php
public function prependColumns(): array
{
    return [];
}
```

Any columns defined in appendColumns() will be the last columns in your list of columns.
```php
public function appendColumns(): array
{
    return [];
}
```

You can call these in your trait, and they will be automatically appended/prepended to tables.

For example, to append a Column for Updated At 
```php
public function appendColumns(): array
{
    return [
        Column::make('Updated At', 'updated_at'),
    ];
}
```
