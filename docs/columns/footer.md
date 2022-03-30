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