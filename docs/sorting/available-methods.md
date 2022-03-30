---
title: Available Methods
weight: 1
---

These are the available sorting configuration methods on the component.

---

Sorting as a whole is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

## setSortingStatus

Enable/disable sorting for the whole component.

```php
public function configure(): void
{
    $this->setSortingStatus(true);
    $this->setSortingStatus(false);
}
```

## setSortingEnabled

Enable sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingStatus(true)
    $this->setSortingEnabled();
}
```

## setSortingDisabled

Disable sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingStatus(false)
    $this->setSortingDisabled();
}
```

---

Single sorting is **enabled by default**, but if you ever needed to toggle it you can use the follow methods:

## setSingleSortingStatus

Enable/disable single sorting for the whole component.

```php
public function configure(): void
{
    $this->setSingleSortingStatus(true);
    $this->setSingleSortingStatus(false);
}
```

## setSingleSortingEnabled

Enable single sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSingleSortingStatus(true)
    $this->setSingleSortingEnabled();
}
```

## setSingleSortingDisabled

Disable single sorting for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSingleSortingStatus(false)
    $this->setSingleSortingDisabled();
}
```

---

There is **no default sort by default**, but if you wanted to add one:

## setDefaultSort

Set the default sorting column and direction.

```php
public function configure(): void
{
    $this->setDefaultSort('name', 'desc');
}
```

If you had the need to programmatically remove the default sort:

## removeDefaultSort

Remove the default sort.

```php
public function configure(): void
{
    $this->removeDefaultSort();
}
```

---

Sorting pills are **enabled by default**, but if you ever needed to toggle it you can use the following methods:

## setSortingPillsStatus

Enable/disable sorting pills for the whole component.

```php
public function configure(): void
{
    $this->setSortingPillsStatus(true);
    $this->setSortingPillsStatus(false);
}
```

## setSortingPillsEnabled

Enable sorting pills for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingPillsStatus(true)
    $this->setSortingPillsEnabled();
}
```

## setSortingPillsDisabled

Disable sorting pills for the whole component.

```php
public function configure(): void
{
    // Shorthand for $this->setSortingPillsStatus(false)
    $this->setSortingPillsDisabled();
}
```

---

## setDefaultSortingLabels

If you would like to set the default sorting labels for the sorting pills you may override them:

By default, they are A-Z for ascending and Z-A for descending.

```php
public function configure(): void
{
    $this->setDefaultSortingLabels('Asc', 'Desc');
}
```
