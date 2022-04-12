---
title: Clickable Rows
weight: 1
---

To enable clickable rows on your table, you may add the following to the table component configuration:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('admin.users.show', $row);
        })
        ->setTableRowUrlTarget(function($row) {
            if ($row->isExternal()) {
                return '_blank';
            }

            return '_self';
        });
}
```

If you would like to make a certain cell unclickable (i.e. if you have something else clickable in that cell), you may do so by adding the following to the column configuration:

```php
Column::make('Name')
    ->unclickable(),
```

**Note:** LinkColumns are not clickable by default to preserve the intended behavior of the link.