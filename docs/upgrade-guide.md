---
title: Upgrade Guide
weight: 5
---

This may not be an exhaustive list, please check out the examples for further clarification.

Upgrading from version 1 to version 2:

## Public properties were replaced by their configuration method counterparts.

For example:

In v1:

```php
public string $primaryKey = 'id';
```

In v2:

```php
public function configure(): void
{
    $this->setPrimaryKey('id');
}
```

## The query can be defined in multiple ways

In version 1, the query was defined with the `query()` method. In version 2, the query is either defined with the `builder()` method or the `$model` property.

## Columns now have different types

In version 1, there was just one Column class. In version 2, there's that same class but also other classes for specified uses, i.e [BooleanColumn](columns/other-column-types).

## Filters now have different types

In version 1, there was just one Filter class In version 2 there is a different filter class for [each type](filters/creating-filters) of filter.

## Applying filters

In version 2, you can [apply filter queries at the filter level](filters/applying-filters#apply-filters-at-the-filter-level).

But if you choose to use the [old method of applying filters](filters/applying-filters#apply-filters-at-the-component-level) at the builder level, the method to grab the filter value is different.

Old:

```php
$this->getFilter('active');
```

New:

```php
$this->getAppliedFilterWithValue('active');
```
