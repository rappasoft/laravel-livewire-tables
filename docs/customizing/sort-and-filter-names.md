---
title: Sort & Filter Names
weight: 1
---

## Customizing the sort names

When clicking sortable column headers, the component will use the column name to text first to define the sorting pill in the UI.

If you don't like the way the name is rendered, you can overwrite it:

```php
public array $sortNames = [
    'email_verified_at' => 'Verification Status',
    '2fa' => 'Two Factor Authentication Status',
];
```

## Customizing the sort direction names

The default sort direction names are A-Z for ascending and Z-A for descending, you can overwrite these on a per-column basis with the following class property:

```php
public array $sortDirectionNames = [
    'enabled' => [
        'asc' => 'Yes',
        'desc' => 'No',
    ],
];
```

## Customizing the filter names

When selecting filters, by default the component will use the filter text to render the filter pill selection above the table.

If you don't like the way the component decided to do this, you may override the actual titles of these pills using a component property:

```php
public array $filterNames = [
    'type' => 'User Type',
    'active' => 'User Status',
];
```
