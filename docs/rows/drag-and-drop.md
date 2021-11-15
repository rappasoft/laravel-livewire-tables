---
title: Sortable
weight: 3
---

**This feature is in beta. This feature is available in v1.10 and above**

**You must include have Livewire Sortable installed for this feature.**

**This feature is based on the [Livewire Sortable](https://github.com/livewire/sortable) plugin and is thereby limited to its features.\
**You must have [Livewire Sortable](https://github.com/livewire/sortable) or [Livewire Sortable.js](https://github.com/nextapps-be/livewire-sortablejs) installed for this feature.**

## A warning about reordering

In order for reordering to work, all rows have to be loaded to the page regardless of if you have pagination on or off. So it's best to only use this feature if you have a minimal amount of rows to work with.

**Note: As of v1.10.3, the state of the table will be remembered instead of being wiped out and replaced when the user is done reordering so they can pick up where they left off.**

## Setup

First to use reordering, you must have a column on your table that handles the order of the rows. This can be called whatever you want, however you need to set the default sorting column and direction to that column for it to make sense:

```php
public string $defaultSortColumn = 'sort';
public string $defaultSortDirection = 'asc';
```

This way the same order your table normally sorts is the same order you will reorder in.

## Enabling

To enable sorting you set the `$reorderEnabled` property to `true`.

```php
public bool $reorderEnabled = true;
```

## Handling Reorder

When a row has been dragged & dropped the table will look for a method on your component called `reorder`:

It will accept a list of items in their new order for you to save.

```php
public function reorder($items): void
{
    foreach ($items as $item) {
        optional(User::find((int)$item['value']))->update(['sort' => (int)$item['order']]);
    }
}
```

The array consists of two elements, `value` and `order`.

`order` is obviously the numerical value for you to save to the `sort` column in your database.

`value` is the unique identifier of the row, which is set by your tables [$primaryKey](../usage/the-primary-key).

If for whatever reason you would like to use a different method for saving the order, you can override it:

```php
public string $reorderingMethod = 'myCustomReorderMethod';
```
