---
title: Eloquent
weight: 1
---

Every DataTable component must define a base query, which is the start of the query that will be appended to for the rest of the components included functionality.

Right now only Eloquent models are supported.

```php
public function query(): Builder
{
    return User::query();
}
```

The query is where you will append custom searching and filters later in the documentation. You should also eager load any relationships you need here as well.

Make sure your query includes a column to be used as the [primary key](../usage/the-primary-key).
