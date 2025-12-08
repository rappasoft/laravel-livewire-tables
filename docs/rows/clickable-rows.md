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

## Custom Row Classes

You can apply CSS classes to rows conditionally based on the record data using the `recordClasses()` method:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->recordClasses(fn($record) => match($record->status) {
            'active' => 'bg-green-100 dark:bg-green-900',
            'inactive' => 'bg-red-100 dark:bg-red-900',
            'pending' => 'bg-yellow-100 dark:bg-yellow-900',
            default => '',
        });
}
```

You can also use a simple string or array of classes:

```php
// Single class string
$this->recordClasses('hover:bg-gray-50');

// Array of classes
$this->recordClasses(['hover:bg-gray-50', 'transition-colors', 'cursor-pointer']);
```

The `recordClasses()` method works alongside `setTrAttributes()` - classes from `recordClasses()` will be merged with any classes set via `setTrAttributes()`.

## Using wire:navigate

To use wire:navigate, you should return "navigate" as the target for setTableRowUrlTarget

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

            return 'navigate';
        });
}

```

