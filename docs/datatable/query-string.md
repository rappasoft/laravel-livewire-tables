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

## Search

The search query string is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

### setQueryStringStatusForSearch

Enable/disable the query string for search

```php
public function configure(): void
{
  $this->setQueryStringStatusForSearch(true);
  $this->setQueryStringStatusForSearch(false);
}
```

### setQueryStringForSearchEnabled

Enable the query string for search

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatusForSearch(true)
  $this->setQueryStringForSearchEnabled();
}
```

### setQueryStringForSearchDisabled

Disable the query string for search

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatusForSearch(false)
  $this->setQueryStringForSearchDisabled();
}
```

### setQueryStringAliasForSearch

Change the Alias in the URL for the search, otherwise defaults to "$tablename-search"

```php
public function configure(): void
{
  $this->setQueryStringAliasForSearch('search');
}
```

## Sorts

The sorts query string is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

### setQueryStringStatusForSort

Enable/disable the query string for sort

```php
public function configure(): void
{
  $this->setQueryStringStatusForSort(true);
  $this->setQueryStringStatusForSort(false);
}
```

### setQueryStringForSortEnabled

Enable the query string for sort

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatusForSort(true)
  $this->setQueryStringForSortEnabled();
}
```

### setQueryStringForSortDisabled

Disable the query string for sort

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatusForSort(false)
  $this->setQueryStringForSortDisabled();
}
```

### setQueryStringAliasForSort

Change the Alias in the URL for the sorts, otherwise defaults to "$tablename-sorts"

```php
public function configure(): void
{
  $this->setQueryStringAliasForSort('sorts');
}
```