---
title: Styling
weight: 5
---

The package offers significant opportunities to customise the look & feel of the core table, as well as other elements (which are documented in the relevant sections).

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

Set a list of attributes to override on the th elements.  Note: If you are using Bulk Actions, then the th for Bulk Actions is [styled separately](../bulk-actions/customisations).

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
### setSearchFieldAttributes

Set a list of attributes to override on the search field

```php
public function configure(): void
{
  $this->setSearchFieldAttributes([
    'class' => 'this that',
  ]);
}
```

By default, this replaces the default classes on the search field, if you would like to keep them, set the default flag to true.

```php
public function configure(): void
{
  $this->setSearchFieldAttributes([
    'default' => true,
    'class' => 'added these classes',
  ]);
}
```

### setCollapsingColumnButtonCollapseAttributes

This customises the look & feel of the button displayed to Collapse an expanded Collapsed Column

```php
public function configure(): void
{
  $this->setCollapsingColumnButtonCollapseAttributes([
    'class' => 'text-blue-500',
  ]);
}
```

By default, this replaces the default classes on the button, if you would like to keep:
Default Colors: set default-colors flag to true.
Default Styling: set default-styling flag to true.

#### Keeping the Default Styling
```php
public function configure(): void
{
  $this->setCollapsingColumnButtonCollapseAttributes([
    'default-styling' => true,
    'class' => 'text-blue-500',
  ]);
}
```

#### Keeping the Default Colors
```php
public function configure(): void
{
  $this->setCollapsingColumnButtonCollapseAttributes([
    'default-colors' => true,
    'class' => 'h-12 w-12',
  ]);
}
```

#### Replacing All
```php
public function configure(): void
{
  $this->setCollapsingColumnButtonCollapseAttributes([
    'class' => 'h-12 w-12 text-blue-500',
  ]);
}
```


### setCollapsingColumnButtonExpandAttributes

This customises the look & feel of the button displayed to Expand a collapsed Collapsed Column

```php
public function configure(): void
{
  $this->setCollapsingColumnButtonExpandAttributes([
    'class' => 'text-red-500',
  ]);
}
```

By default, this replaces the default classes on the button, if you would like to keep:
Default Colors: set default-colors flag to true.
Default Styling: set default-styling flag to true.

#### Keeping the Default Styling
```php
public function configure(): void
{
  $this->setCollapsingColumnButtonExpandAttributes([
    'default-styling' => true,
    'class' => 'text-red-500',
  ]);
}
```

#### Keeping the Default Colors
```php
public function configure(): void
{
  $this->setCollapsingColumnButtonExpandAttributes([
    'default-colors' => true,
    'class' => 'h-12 w-12',
  ]);
}
```

#### Replacing All
```php
public function configure(): void
{
  $this->setCollapsingColumnButtonExpandAttributes([
    'class' => 'h-12 w-12 text-red-500',
  ]);
}
```
