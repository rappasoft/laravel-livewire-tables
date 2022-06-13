---
title: Secondary Header
weight: 6
---

A secondary header is a body table row underneath the `thead` that can serve whatever purpose you need. It is passed the current rows of the table at the time so you can use it to tally numbers or show messages based on those rows.

Here is you how define a secondary header for a column:

```php
Column::make('Price')
    ->sortable()
    ->secondaryHeader(function($rows) {
        return 'Subtotal: ' . $rows->sum('price');
    }),
```

The secondary header row is enabled when ever any column calls `secondaryHeader`.

See also [secondary header component configuration](../secondary-header/available-methods).

## Using a filter as a secondary header

As of version 2.7, you can use a filter as a header.

```php
// Example filter
SelectFilter::make('Active')
    ->hiddenFromAll(), // Optional, hides the filter from the menus, pills, count.

// You can pass a filter directly
Column::make('Active')
    ->secondaryHeader($this->getFilterByKey('active')),

// Or use the shorthand method
Column::make('Active')
    ->secondaryHeaderFilter('active'), // Takes the key from the filter, which you can find in the query string when the filter is applied.
```