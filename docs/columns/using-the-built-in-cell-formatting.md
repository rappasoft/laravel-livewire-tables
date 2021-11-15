---
title: Built-in cell formatting
weight: 4
---

If you are not using a custom row view, the cells will auto-format themselves.

I.e. If you are not using `rowView()` in your table, the component will attempt to display the cell contents by just getting the value from the model.

**Note:** If you know you are going to need more customization that the column formatter can support from the start, I would skip the column formatter and use a [Custom Row View](../rows/custom-row-view).

The following documentation is if you want to overwrite that default formatting functionality:

If you would like to format the cell inline:

```php
Column::make('Created On')
    ->sortable()
    ->format(function($value) {
        return timezone()->convertToLocal($value);
    }),
```

**Note:** If you need more control, the full parameter list for the format callback is `$value, $column, $row`.

If you would like to render HTML from the format method, you may call `asHtml` on the column.

```php
Column::make('Created On')
    ->sortable()
    ->format(function($value) {
        return '<strong>'.timezone()->convertToLocal($value).'</strong>';
    })
    ->asHtml(),
```

You could also return a view:

```php
Column::make('Name')
    ->sortable()
    ->format(function($value, $column, $row) {
        return view('admin.user.actions')->withUser($row);
    }),
```

Be sure to check out the [Custom Row View](../rows/custom-row-view) page to see how you can have full control over your row.
