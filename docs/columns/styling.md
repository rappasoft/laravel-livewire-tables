---
title: Styling
weight: 10
---

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

## Styling The Column Label

The Column itself provides the capability to style the Label shown in the "th" element.  You can set custom attributes to pass to the Column Label on a per-Column basis:

For example:
```php
Column::make('Name')
    ->setLabelAttributes(['class' => 'text-2xl'])
```
By default, this replaces the default classes on the label, if you would like to keep them, set the default/default-styling/default-colors flags to true as appropriate.

## Styling Table Elements

It is important to note that you can also customise the parent TH and TD elements, customising both classes and attributes for each Column's header (using setThAttributes) and each row of that Column (using setTdAttributes), these are available in the configure() method of the table.
This allows you to customise attributes based on the value of the table as well!

Below is a copy of the relevant sections from [datatable styling](../datatable/styling) to ensure visibility of the options.  More are documented on the main datatable styling page.

## setThAttributes

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

### Keeping Default Colors and Default Styling
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

### Keeping Default Styling Only For the "Name" Column
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

### Reorder Column
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

### Bulk Actions Column
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

## setThSortButtonAttributes

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

## setTrAttributes

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

By default, this replaces the default classes on the tr, if you would like to keep them, set the appropriate default flag (see above)

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

## setTdAttributes

Set a list of attributes to override on the td elements.  For example, changing the background color between red/green based on whether the "total" field is over or under 1000.

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
    elseif ($column->isField('total') && $row->total >= 1000) {
      return [
        'class' => 'bg-green-500 text-white',
      ];
    }

    return [];
  });
}
```

By default, this replaces the default classes on the td, if you would like to keep them, set the appropriate default flag (see above).

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

### Reorder Column
Note: If you are using Reorder, then the td for Reorder can be [styled separately](../reordering/available-methods).  However this is now replaced with the following to ensure consistent behaviour.  The separate method will be supported until at least v3.6

You can use the "title" of the Column, which will be "reorder" for the "reorder" Column:
```php
public function configure(): void
{
  $this->setTdAttributes(function(Column $column) {
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

### Bulk Actions Column
Note: If you are using Bulk Actions, then the td for Bulk Actions can be [styled separately](../bulk-actions/customisations).  However this is now replaced with the following to ensure consistent behaviour.  The separate method will be supported until at least v3.6

You can use the "title" of the Column, which will be "bulkactions" for the "Bulk Actions" Column:
```php
public function configure(): void
{
  $this->setTdAttributes(function(Column $column) {
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
