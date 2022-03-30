---
title: Setup
weight: 2
---

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

By default the method that will be called when a row is moved is `reorder`.

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
