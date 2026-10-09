---
title: Setup
weight: 2
---

## Tables sharing a page

Give every table on the page a distinct `$tableName` and matching public data array, even when the query string is disabled. Reordering and its saved state use that name in their session keys. Renaming the reorder method does not isolate those keys. See [Multiple Tables Same Page](../misc/multiple-tables.md).

```php
public string $tableName = 'users';
public array $users = [];
```

## Specify your reorder column and direction

By default the reorder column will be `sort` and the direction will be `asc`.

If you want to change that:

```php
public function configure(): void
{
    $this->setDefaultReorderSort('order', 'desc');
}
```

## Specify your reorder method

By default the method that will be called when the save button is clicked is `reorder`.

If you want to change that:

```php
public function configure(): void
{
    $this->setReorderMethod('changeOrder');
}
```

## Hiding the reorder column unless reordering

If your reorder column is part of your table definition, it will be visible by default. If you want to hide it unless reordering is active you may call this method:

```php
public function configure(): void
{
    $this->setHideReorderColumnUnlessReorderingEnabled();
}
```
