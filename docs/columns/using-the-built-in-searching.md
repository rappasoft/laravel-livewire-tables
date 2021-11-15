---
title: Built-in searching
weight: 2
---

There are multiple ways to apply searching to a column, but the easiest is using the built-in column searchable() method.

**Note:** When it comes to searching, you must use either the column search or the search filter, not both. If you know you need more advanced searching from the start, opt for the search filter over the column searching.

```php
Column::make('Type')
    ->searchable(),
```

You can also apply it to relationship columns:

```php
Column::make('Address', 'attributes.address')
    ->searchable(),
```

You can override the default search query using a closure:

```php
Column::make('Type')
    ->searchable(function (Builder $query, $searchTerm) {
        $query->orWhere(...);
    }),
```

If you do not add the searchable() method then the column will not be included when searching the term.

For more advanced search abilities, take a look at the [search filter docs](../filters/the-search-filter).
