---
title: Query String
weight: 5
---

The query string is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

## Global 
### setQueryStringStatus

Enable/disable the query string.

```php
public function configure(): void
{
  $this->setQueryStringStatus(true);
  $this->setQueryStringStatus(false);
}
```

### setQueryStringEnabled

Enable the query string.

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatus(true)
  $this->setQueryStringEnabled();
}
```

### setQueryStringDisabled

Disable the query string.

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatus(false)
  $this->setQueryStringDisabled();
}
```

### setQueryStringAlias

Change the Alias in the URL, otherwise defaults to "$tablename"

```php
public function configure(): void
{
  $this->setQueryStringAlias('table1');
}
```

## Filters

The filter query string is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

### setQueryStringStatusForFilter

Enable/disable the query string for the filters

```php
public function configure(): void
{
  $this->setQueryStringStatusForFilter(true);
  $this->setQueryStringStatusForFilter(false);
}
```

### setQueryStringForFilterEnabled

Enable the query string for the filters

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatusForFilter(true)
  $this->setQueryStringForFilterEnabled();
}
```

### setQueryStringForFilterDisabled

Disable the query string for the filters

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatusForFilter(false)
  $this->setQueryStringForFilterDisabled();
}
```

### setQueryStringAliasForFilter

Change the Alias in the URL for the filter, otherwise defaults to "$tablename-filters"

```php
public function configure(): void
{
  $this->setQueryStringAliasForFilter('filtervalues');
}
```