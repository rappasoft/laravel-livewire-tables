---
title: Available Methods
weight: 1
---

These are the available configuration methods on the datatable component.

## General

### setPrimaryKey

Set the primary key column of the component.

```php
public function configure(): void
{
  $this->setPrimaryKey('id');
}
```

### useComputedPropertiesDisabled

If you have published the Views **prior to v3.4.5**, and do not wish to remove the published views, then you should add the following call, which will disable the new Computed Properties behaviour.  Note that publishing the views is not recommended!

```php
public function configure(): void
{
  $this->useComputedPropertiesDisabled();
}
```


## Attributes

Documentation for Data Table Styling/Attributes is now: [Here](../datatable/styling)

## Offline

Offline indicator is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

Enable/disable the offline indicator.

### setOfflineIndicatorStatus

```php
public function configure(): void
{
  $this->setOfflineIndicatorStatus(true);
  $this->setOfflineIndicatorStatus(false);
}
```

### setOfflineIndicatorEnabled

Enable the offline indicator.

```php
public function configure(): void
{
  // Shorthand for $this->setOfflineIndicatorStatus(true)
  $this->setOfflineIndicatorEnabled();
}
```

### setOfflineIndicatorDisabled

Disable the offline indicator.

```php
public function configure(): void
{
  // Shorthand for $this->setOfflineIndicatorStatus(false)
  $this->setOfflineIndicatorDisabled();
}
```

## Query String

The documentation for Query String now lives: [here](./query-string)

## Relationships

**Disabled by default**, enable to eager load relationships for all columns in the component.

### setEagerLoadAllRelationsStatus

Enable/disable column relationship eager loading.

```php
public function configure(): void
{
  $this->setEagerLoadAllRelationsStatus(true);
  $this->setEagerLoadAllRelationsStatus(false);
}
```

### setEagerLoadAllRelationsEnabled

Enable column relationship eager loading.

```php
public function configure(): void
{
  // Shorthand for $this->setEagerLoadAllRelationsStatus(true)
  $this->setEagerLoadAllRelationsEnabled();
}
```

### setEagerLoadAllRelationsDisabled

Disable column relationship eager loading.

```php
public function configure(): void
{
  // Shorthand for $this->setEagerLoadAllRelationsStatus(false)
  $this->setEagerLoadAllRelationsDisabled();
}
```

## Builder

### setAdditionalSelects

By default the only columns defined in the select statement are the ones defined via columns. If you need to define additional selects that you don't have a column for you may:

Note - that you may only call this once, and it will override any existing additionalSelects in use.

```php
public function configure(): void
{
  $this->setAdditionalSelects(['users.id as id']);
}
```

Since you probably won't have an `ID` column defined, the ID will not be available on the model to use. In the case of an actions column where you have buttons specific to the row, you probably need that, so you can add the select statement to make it available on the model.

### addAdditionalSelects

By default the only columns defined in the select statement are the ones defined via columns. If you need to define additional selects that you don't have a column for you may:

Note - that in contrast to setAdditionalSelects, you may call this multipole times, and it will append the additional selects.  Take care not to re-use the same field names!

```php
public function configure(): void
{
  $this->addAdditionalSelects(['users.id as id']);
}
```

## Misc.

### setEmptyMessage

Set the message displayed when the table is filtered but there are no results to show.

Defaults to: "_No items found, try to broaden your search._"

```php
public function configure(): void
{
  $this->setEmptyMessage('No results found');
}
```