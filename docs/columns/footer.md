---
title: Footer
weight: 7
---

A footer is a `tfoot` element under the body rows that can serve whatever purpose you need. It is passed the current rows of the table at the time so you can use it to tally numbers or show messages based on those rows.

Here is you how define a footer for a column:

```php
Column::make('Price')
    ->sortable()
    ->footer(function($rows) {
        return 'Subtotal: ' . $rows->sum('price');
    }),
```

The footer row is enabled when ever any column calls `footer`.

See also [footer component configuration](../footer/available-methods).

## Using a filter as a footer

As of version 2.7, you can use a filter as a footer.

```php
// Example filter
SelectFilter::make('Active')
    ->hiddenFromAll(), // Optional, hides the filter from the menus, pills, count.

// You can pass a filter directly
Column::make('Active')
    ->footer($this->getFilterByKey('active')),

// Or use the shorthand method
Column::make('Active')
    ->footerFilter('active'), // Takes the key from the filter, which you can find in the query string when the filter is applied.
```