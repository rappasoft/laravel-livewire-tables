---
title: User column selection
weight: 6
---

**This feature is available in v1.10 and above**

**This feature is off by default.**

To enable this feature, add this property to your table:

```php
public bool $columnSelect = true;
```

You can exclude columns from the column selector list so that they can not be hidden:

```php
Column::make('email')
    ->excludeFromSelectable(),
```

Working with custom row views:

When working with custom row views, the column selector will hide the headers but will not know how to handle the cells. You can manually hide each cell depending on the column key like so:

```php
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('email')))
    // This column is selected or column select is off
@endif
```

**Note:** If you enable column select and then add new columns, they will be hidden by default.

**This feature is available in v1.14 and above**

## Disabling the column selection session

To disable the session remembering the user's column selection and revert to the default on each page load:

```php
public bool $rememberColumnSelection = false;
```

## Pre-selecting columns

To pre-select columns for the first time the user loads the table (the session storage will take over on subsequent requests, unless the $rememberColumnSelection bool is set to false):

```php
Column::make('email')
    ->selected(),
```
