---
title: Events
weight: 2
---

### Listened For
These are the available events on the datatable component that you can fire from your application, or client-side

#### refreshDatatable

```php
$this->dispatch('refreshDatatable');
```

Calls `$refresh` on the component. Good for updating from external sources or as an alternative to polling.

#### setSort

You can have the table sort a specific column:

```php
$this->dispatch('setSort', 'name', 'asc');
```

#### clearSorts

You can clear all the applied sorts:

```php
$this->dispatch('clearSorts');
```

#### setFilter

You can have the table run a specific filter:

```php
$this->dispatch('setFilter', 'status', '1');
```

#### clearFilters

You can have the table clear all filters:

```php
$this->dispatch('clearFilters');
```

### Dispatched

There are several events, all in the Rappasoft\LaravelLivewireTables\Events namespace
| Event Name | Event Purpose | Data Passed |
| --- | --- | --- |
| ColumnsSelected | Applied whenever a Column is selected/deselected from view | The Table Name ($tableName), Selected Columns ($value), Logged In User ($user) |
| FilterApplied | Applied when a Filter is applied (not when removed) |  The Table Name ($tableName), Filter Key ($key), Filter Value ($value), Logged In User ($user) |
| SearchApplied | Applied when a Search is applied (not when removed) | The Table Name ($tableName), Search Term ($value), Logged In User ($user) |

Passing the user with an event is optional and [can be disabled in the config](../start/configuration.md#bypassing-laravels-auth-service).

By default, the Tables will dispatch an event when the Selected Columns is changed, you may customise this behaviour:

#### enableAllEvents

This enables all Dispatched Events.  This should be used with caution, as more events will be introduced in the future.

```php
public function configure(): void
{
  $this->enableAllEvents();
}
```

#### disableAllEvents

This disables all Dispatched Events.

```php
public function configure(): void
{
  $this->disableAllEvents();
}
```

#### enableColumnSelectEvent

Enables the Column Select Event, has no impact on other events

```php
public function configure(): void
{
  $this->enableColumnSelectEvent();
}
```

#### disableColumnSelectEvent

Disables the Column Select Event, has no impact on other events

```php
public function configure(): void
{
  $this->disableColumnSelectEvent();
}
```

#### enableSearchAppliedEvent

Enables the Search Applied Event, has no impact on other events

```php
public function configure(): void
{
  $this->enableSearchAppliedEvent();
}
```

#### disableSearchAppliedEvent

Disables the Search Applied Event, has no impact on other events

```php
public function configure(): void
{
  $this->disableSearchAppliedEvent();
}
```

#### enableFilterAppliedEvent

Enables the Filter Applied Event, has no impact on other events

```php
public function configure(): void
{
  $this->enableFilterAppliedEvent();
}
```

#### disableFilterAppliedEvent

Disables the Filter Applied Event, has no impact on other events

```php
public function configure(): void
{
  $this->disableFilterAppliedEvent();
}
```
