---
title: Creating Columns
weight: 1
---

The `columns` method on your component must return an array of Column objects in the order you wish to see them on the table:

```php
public function columns(): array
{
    return [
        Column::make('Name'),
        Column::make('Email'),
    ];
}
```

## Setting field names

By default, you only need one parameter which acts as the header of the column, the field which it references will be acquired using `Str::snake`.

So if you have:

```php
public function columns(): array
{
    return [
        Column::make('Name'), // Looks for column `name`
        Column::make('Email'), // Looks for column `email`
    ];
}
```

Of course, this won't work in every situation, for example if you have an ID column, Str::snake will convert it to `i_d` which is incorrect. For this situation and any other situation where you want to specify the field name, you can pass it as the second parameter:

```php
public function columns(): array
{
    return [
        Column::make('ID', 'id'),
        Column::make('E-mail', 'email'),
    ];
}
```

## Setting an alias

When not supplying an alias, the field name is used in the query string and other locations as the column identifier.
You can change that behavior by adding an alias.

```php
public function columns(): array
{
    return [
        Column::make('ID', 'id', 'my_id'),
        Column::make('JSON field', 'data->user->id', 'user_id'),
    ];
}
```

The datatable will use the alias also in the SQL query:

```sql
select "id" as "my_id", "data"->'user'->>'id' as "user_id" from "table" order by "user_id" asc limit 10 offset 0
```

and in the URL:
```
?my-table[sorts][user_id]=asc
```
