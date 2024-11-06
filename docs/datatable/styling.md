---
title: Styling
weight: 6
---

The package offers significant opportunities to customise the look & feel of the core table, as well as other elements (which are documented in the relevant sections).

## Keeping Defaults
To allow simpler customisation on a per-table basis, there are numerous methods available to over-ride the default CSS classes.
Historically, this was provided by a simple toggleable "default" flag.  However - in many cases, the original "default" has been expanded to include:

### Keep Default Colors And Default Styles
- set default flag to true
or
- set default-colors flag to true
- set default-styling flag to true

### Keep Default Colors Only
- set default flag to false
- set default-colors flag to true
- set default-styling flag to false

### Keep Default Styling Only
- set default flag to false
- set default-colors flag to false
- set default-styling flag to true


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

Set a list of attributes to override on the th elements.  

If your Column does not have a field (e.g. a label column), then you may use the following, which will utilise the first parameter in Column::make()
```php
  $column->getTitle()
```

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

#### Keeping Default Colors and Default Styling
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

#### Keeping Default Styling Only For the "Name" Column
```php
public function configure(): void
{
  $this->setThAttributes(function(Column $column) {
    if ($column->isField('name')) {
      return [
        'default' => false,
        'default-styling' => true,
        'class' => 'text-black bg-green-500 dark:text-white dark:bg-green-900',
      ];
    }

    return ['default' => true];
  });
}
```

#### Reorder Column
Note: If you are using Reorder, then the th for Reorder can be [styled separately](../reordering/available-methods).  However this is now replaced with the following to ensure consistent behaviour.  The separate method will be supported until at least v3.6

You can also use the "title" of the Column, which will be "reorder" for the "reorder" Column:
```php
public function configure(): void
{
  $this->setThAttributes(function(Column $column) {
      if ($column->getTitle() == 'reorder')
      {
          return [
              'class' => 'bg-green-500 dark:bg-green-800',
              'default' => false,
              'default-colors' => false,
          ];
  
      }

    return ['default' => true];
  });
}
```
#### Bulk Actions Column
Note: If you are using Bulk Actions, then the th for Bulk Actions can be [styled separately](../bulk-actions/customisations).  However this is now replaced with the following to ensure consistent behaviour.  The separate method will be supported until at least v3.6

You can also use the "title" of the Column, which will be "bulkactions" for the "Bulk Actions" Column:
```php
public function configure(): void
{
  $this->setThAttributes(function(Column $column) {
      if ($column->getTitle() == 'bulkactions')
      {
          return [
              'class' => 'bg-yellow-500 dark:bg-yellow-800',
              'default' => false,
              'default-colors' => false,
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

If your Column does not have a field (e.g. a label column), then you may use the following, which will utilise the first parameter in Column::make()
```php
  $column->getTitle()
```

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

### Vertical Scrolling Example
Should you wish to implement a table with a responsive height, and vertical scrolling for additional rows, a basic example is below that demonstrates the approach, noting that you will likely wish to adjust the break-points!

```php
public function configure(): void
{

    $this->setTableWrapperAttributes([
        'class' => 'max-h-56 md:max-h-72 lg:max-h-96 overflow-y-scroll',
        ]);
    $this->setTheadAttributes([
        'class' => 'sticky top-0 '
    ]);
}
```

Keep in mind that you must only call methods from configure() once to avoid overriding or conflicting results.