---
title: Footer Functionality
weight: 8
---

**The following footer methods are only available in v1.16 and above**

You have 2 options when it comes to footer rows:

## 1. Use the header as the footer

```php
public bool $useHeaderAsFooter = true;
```

This literally duplicates the header, including bulk selection, sorting, etc.

## 2. Customize the footer cell for each column

You can pass a `footer` method to each column which will be passed all the rows that are on that page.

```php
Column::make('Sales')
    ->sortable()
    ->footer(fn($rows) => 'Total: ' . $rows->sum('sales')),
```

```php
Column::make('Sales')
    ->sortable()
    ->asHtml()
    ->footer(fn($rows) => '<strong>Total:</strong> ' . $rows->sum('sales')),
```

```php
Column::make('Sales')
    ->sortable()
    ->footer(fn($rows) => view('includes.cells.sales')->withRows($rows)),
```

Calling `footer` on any column will enable the custom footer, any column without a `footer` method will just contain a blank cell.

See also, [row and cell customization](../display/customizing-table-rows-and-cells).

**Note:** the `asHtml()` column method is used for both the data and the secondary header/footer cells.
