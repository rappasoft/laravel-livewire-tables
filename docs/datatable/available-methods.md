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

## Attributes

### setComponentWrapperAttributes

Set a list of attributes to override on the main wrapper of the component

```php
public function configure(): void
{
  $this->setComponentWrapperAttributes([
    'id' => 'my-id',
    'class' => 'this that',
  ]);
}
```

### setTableWrapperAttributes

Set a list of attributes to override on the div that wraps the table

```php
public function configure(): void
{
  $this->setTableWrapperAttributes([
    'id' => 'my-id',
    'class' => 'this that',
  ]);
}
```

By default, this replaces the default classes on the table wrapper, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  $this->setTableWrapperAttributes([
    'default' => true,
    'class' => 'added these classes',
  ]);
}
```

### setTableAttributes

Set a list of attributes to override on the table element

```php
public function configure(): void
{
  $this->setTableAttributes([
    'id' => 'my-id',
    'class' => 'this that',
  ]);
}
```

By default, this replaces the default classes on the table, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  $this->setTableAttributes([
    'default' => true,
    'class' => 'added these classes',
  ]);
}
```

### setTheadAttributes

Set a list of attributes to override on the thead element

```php
public function configure(): void
{
  $this->setTheadAttributes([
    'id' => 'my-id',
    'class' => 'this that',
  ]);
}
```

By default, this replaces the default classes on the thead, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  $this->setTheadAttributes([
    'default' => true,
    'class' => 'added these classes',
  ]);
}
```

### setTbodyAttributes

Set a list of attributes to override on the tbody element

```php
public function configure(): void
{
  $this->setTbodyAttributes([
    'id' => 'my-id',
    'class' => 'this that',
  ]);
}
```

By default, this replaces the default classes on the tbody, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  $this->setTbodyAttributes([
    'default' => true,
    'class' => 'added these classes',
  ]);
}
```

### setThAttributes

Set a list of attributes to override on the th elements

```php
public function configure(): void
{
  // Takes a callback that gives you the current column.
  $this->setThAttributes(function(Column $column) {
    if ($column->isField('name')) {
      return [
        'class' => 'bg-green-500',
      ];
    }

    return [];
  });
}
```

### setThSortButtonAttributes

Set a list of attributes to override on the th sort button elements

```php
public function configure(): void
{
  // Takes a callback that gives you the current column.
  $this->setThSortButtonAttributes(function(Column $column) {
    if ($column->isField('name')) {
      return [
        'class' => 'bg-green-500',
      ];
    }

    return [];
  });
}
```

By default, this replaces the default classes on the th, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  $this->setThAttributes(function(Column $column) {
    if ($column->isField('name')) {
      return [
        'default' => true,
        'class' => 'bg-green-500',
      ];
    }

    return ['default' => true];
  });
}
```

### setTrAttributes

Set a list of attributes to override on the tr elements

```php
public function configure(): void
{
  // Takes a callback that gives you the current row and its index
  $this->setTrAttributes(function($row, $index) {
      if ($index % 2 === 0) {
        return [
          'class' => 'bg-gray-200',
        ];
      }

      return [];
  });
}
```

By default, this replaces the default classes on the tr, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  $this->setTrAttributes(function($row, $index) {
      if ($index % 2 === 0) {
        return [
          'default' => true,
          'class' => 'bg-gray-200',
        ];
      }

      return ['default' => true];
  });
}
```

### setTdAttributes

Set a list of attributes to override on the td elements

```php
public function configure(): void
{
  // Takes a callback that gives you the current column, row, column index, and row index
  $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
    if ($column->isField('total') && $row->total < 1000) {
      return [
        'class' => 'bg-red-500 text-white',
      ];
    }

    return [];
  });
}
```

By default, this replaces the default classes on the td, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  // Takes a callback that gives you the current column, row, column index, and row index
  $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
    if ($column->isField('total') && $row->total < 1000) {
      return [
        'default' => true,
        'class' => 'bg-red-500 text-white',
      ];
    }

    return ['default' => true];
  });
}
```

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

The query string is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

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

```php
public function configure(): void
{
  $this->setAdditionalSelects(['users.id as id']);
}
```

Since you probably won't have an `ID` column defined, the ID will not be available on the model to use. In the case of an actions column where you have buttons specific to the row, you probably need that, so you can add the select statement to make it available on the model.

## Misc.

### setEmptyMessage

Set the message displayed when the table is filtered but there are no results to show.

Defaults to: "_No items found. Try to broaden your search._"

```php
public function configure(): void
{
  $this->setEmptyMessage('No results found');
}
```
