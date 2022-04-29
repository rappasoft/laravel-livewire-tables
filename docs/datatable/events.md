---
title: Events
weight: 2
---

These are the available events on the datatable component that you can fire from your application:

### refreshDatatable

```php
$this->emit('refreshDatatable');
```

Calls `$refresh` on the component. Good for updating from external sources or as an alternative to polling.

### setSort

You can have the table sort a specific column:

```php
$this->emit('setSort', 'name', 'asc');
```

### clearSorts

You can clear all the applied sorts:

```php
$this->emit('clearSorts');
```

### setFilter

You can have the table run a specific filter:

```php
$this->emit('setFilter', 'status', '1');
```

### clearFilters

You can have the table clear all filters:

```php
$this->emit('clearFilters');
```