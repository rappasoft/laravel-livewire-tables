---
title: Creating Columns
weight: 1
---

The `columns` method on your component must return an array of Column objects in the order you wish to see them on the table:

```php
public function columns(): array
{
    Column::make('Name'),
    Column::make('Email'),
}
```

## Setting field names

By default, you only need one parameter which acts as the header of the column, the field which it references will be acquired using `Str::snake`.

So if you have:

```php
Column::make('Name') // Looks for column `name`
Column::make('Email') // Looks for column `email`
```

Of course, this won't work in every situation, for example if you have an ID column, Str::snake will convert it to `i_d` which is incorrect. For this situation and any other situation where you want to specify the field name, you can pass it as the second parameter:

```php
Column::make('ID', 'id'),
Column::make('E-mail', 'email'),
```
