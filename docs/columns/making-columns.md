---
title: Making Columns
weight: 1
---

Defining columns is required in every DataTable regardless of if you're using built-in or custom features.

You define columns in the columns() method using the Column class, you must have one column object for every table header, even if it is blank (see making blank columns).

```php
public function columns(): array
{
    return [
        Column::make('Type'),
        Column::make('Name'),
        Column::make('E-mail'),
        Column::make('Permissions'),
    ];
}
```

The Column class takes two parameters, the first is the display title of the column header, the second is the database column or relationship name and column for sorting and searching purposes.

If you leave it blank, the component will use the snake_case version of the title.

For example:

```php
public function columns(): array
{
    return [
        Column::make('Type'), // column = type
        Column::make('Name'), // column = name
        Column::make('E-mail'), // column = e-mail <- BAD
        Column::make('Permissions'), // column = permissions
    ];
}
```

As you can see above, E-mail contains a special character and therefore does not directly translate to the column name, so you would specify it as the second parameter:

```php
Column::make('E-mail', 'email'),
```

To pull from a relationship, you can use the dot syntax:

```php
Column::make('Permissions', 'abilities.permissions'),
```
