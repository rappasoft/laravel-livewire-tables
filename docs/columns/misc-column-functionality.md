---
title: Misc. Functionality
weight: 9
---

## Adding a class to the column headers

```php
Column::make('Other')
    ->addClass('hidden md:table-cell'), // Hide this header on mobile
```

## Adding any attribute to the column headers

```php
Column::make('Other')
    ->addAttributes(['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Tooltip on top']),
```
