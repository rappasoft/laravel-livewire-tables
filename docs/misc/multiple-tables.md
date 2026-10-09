---
title: Multiple Tables Same Page
weight: 3
---

This feature works for mutiple tables on the same page that are **different** components.

This feature **does not work** for multiple tables on the same page that are the **same component** but take different parameters.

> **Set a distinct `$tableName` on every table sharing a page — even if you do not use the query string.**
>
> `$tableName` defaults to `table` for every component, and it keys more than the query string: it also keys the reordering session, the stored filters, and the stored column selection. Two tables that both keep the default silently share all of that state, which shows up as one table loading another's rows when you start reordering. See [What the table name keys](#what-the-table-name-keys) below.

---

For example, this works:

```html
<livewire:users-table />

<livewire:roles-table />
```

But this does not work:

```html
<livewire:users-table status="active" />

<livewire:users-table status="pending" />
```

If you need the above, you should make them different components like so:

```html
<livewire:active-users-table />

<livewire:pending-users-table />
```

## Introduction

By default, your table has a name of `table`, as well as an internal array called `$table` which saves its state to the query string.

The query string would look like this:

```php
// Under the hood
public array $queryString = [
    'table' => [
        'search' => null,
        'sort' => [],
        ...
    ],
]
```

In order to have multiple tables on the same page, you need to tell it how to save the state of each table.

## Setting the table name and data

If you have multiple tables on the same page and you want them to have independent state saved in the query string, you must set a table name and data array.

```php
public string $tableName = 'users';
public array $users = [];
```

The data array must be the same name as the table name. This data array will remain blank, I tried to create it dynamically in the query string but Livewire doesn't support that, so you have to define it yourself. It is a workaround until Livewire supports dynamic properties for the query string.

Your query string will now look like this:

```php
// Under the hood
public array $queryString = [
    'users' => [
        'search' => null,
        'sort' => [],
        ...
    ],
    // Other tables
    'roles' => [
        'search' => null,
        'sort' => [],
        ...
    ],
]
```

## What the table name keys

The table name is not only a query string prefix. These are all derived from it, so two tables sharing a name share the value behind each one:

| Key | Used for |
| --- | --- |
| `{tableName}` | The query string array |
| `{tableName}-reordering` | Whether the table is currently being reordered |
| `{tableName}-reordering-backup` | The table state to restore when reordering is cancelled |
| `{tableName}-stored-filters` | Filters persisted to the session |
| `{tableName}-stored-columnselect` | Column selection persisted to the session |

The `filter-was-set` event and the `FilterApplied` / `ColumnsSelected` events also carry the table name as their only identifier, so a listener cannot tell two identically named tables apart.

Giving each table its own name is enough to separate all of the above:

```php
public string $tableName = 'users';
public array $users = [];
```

## Disabling the query string for multiple of the same component

If you must have multiple of the same component on the same page, you should disable the query string for those components so the query string state does not get replaced by one or the other:

```php
public function configure(): void
{
    $this->setQueryStringDisabled();
}
```

## Disabling column selection for multiple of the same component

You should also disable the columns selection for those components so the column selection state does not get replaced by one or the other:

```php
public function configure(): void
{
    $this->setColumnSelectStatus(false);
}
```
