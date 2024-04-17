---
title: Events
weight: 2
---

These are the available events on the datatable component that you can fire from your application:

### refreshDatatable

```php
$this->dispatch('refreshDatatable');
```

Calls `$refresh` on the component. Good for updating from external sources or as an alternative to polling.

### setSort

You can have the table sort a specific column:

```php
$this->dispatch('setSort', 'name', 'asc');
```

### clearSorts

You can clear all the applied sorts:

```php
$this->dispatch('clearSorts');
```

### setFilter

You can have the table run a specific filter:

```php
$this->dispatch('setFilter', 'status', '1');
```

### clearFilters

You can have the table clear all filters:

```php
$this->dispatch('clearFilters');
```
