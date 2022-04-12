---
title: Available Methods
weight: 3
---

## Sorting

See also [component sorting configuration](../sorting/available-methods).

To enable sorting you can chain the `sortable` method on your column:

```php
Column::make('Name')
    ->sortable()
```

If you would like more control over the sort behavior of a specific column, you may pass a closure:

```php
Column::make(__('Address'))
    ->sortable(function(Builder $query, string $direction) {
        return $query->orderBy()...
    })
```

### [Multi-column sorting](../sorting/available-methods#setsinglesortingstatus)

In v2, multi-column sorting is **disabled by default**. To enable it you can set the `setSingleSortingDisabled()` method on the component.

```php
public function configure(): void
{
    $this->setSingleSortingDisabled();
}
```

Multi-column sorting is now enabled in the order the column headers are clicked.

### [Default column sorting](../sorting/available-methods#setdefaultsort)

By default, there is no default column sorting and the table will be displayed in the order the query has it listed. To enable default sorting you can use this method on your component:

```php
public function configure(): void
{
    $this->setDefaultSort('name', 'desc');
}
```

## Searching

See also [component search configuration](../search/available-methods).

To enable searching you can chain the `searchable` method on your column:

```php
Column::make('Name')
    ->searchable()
```

You can override the default search query using a closure:

```php
Column::make('Name')
    ->searchable(function (Builder $query, $searchTerm) {
        $query->orWhere(...);
    }),
```

## Formatting

By default, the component will use the column value as the cell value.

You can either modify that value or bypass it entirely.

### Modifying the column value

If you would like to modify the value of the column, you can chain the `format` method:

```php
Column::make('Name')
    ->format(function($value, $row, Column $column) {
        return $row->first_name . ' ' . $row->last_name;
    })
```

### Rendering HTML

If you would like to return HTML from the format method you may:

```php
Column::make('Name')
    ->format(function($value, $row, Column $column) {
        return '<strong>'.$row->first_name . ' ' . $row->last_name.'</strong>';
    })
    ->html()
```

### Using a view

If you would like to render a view for the cell:

```php
Column::make('Name')
    ->format(function($value, $row, Column $column) {
        return view('my.custom.view')->withValue($value);
    })
```

As a shorthand you can use the following:

```php
Column::make('Name')
    ->view('my.custom.view')
```

You will have access to `$row`, `$value`, and `$column` from within your view.

## Labels

If you have a column that is not associated with a database column, you can chain the `label` method:

```php
Column::make('My one off column')
    ->label(function($row, Column $column) {
        return $this->getSomeOtherValue($row, $column);
    })
```

You can return HTML:

```php
Column::make('My one off column')
    ->label(function($row, Column $column) {
        return '<strong>'.$row->this_other_column.'</strong>';
    })
    ->html()
```

You can also return a view:

```php
Column::make('My one off column')
    // Note: The view() method is reserved for columns that have a field
    ->label(function($row, Column $column) {
        return view('my.other.view')->withRow($row);
    })
```

## Collapsing

The component has the ability to collapse certain columns at different screen sizes. It will add a plus icon as the left most column that will open up a view below the row with the information of the collapsed columns:

![Collapsing](https://imgur.com/z1rWHzP.png)

You have 2 options when it comes to collapsing.

Collapse on tablet:

```php
Column::make('Name')
    ->collapseOnTablet()
```

The columns will collapse on tablet and mobile.

Collapse on mobile:

```php
Column::make('Name')
    ->collapseOnMobile()
```

The column will collapse on mobile only.

The view will be rendered with the order of the columns as they were initially shown.

## Customization

### Customizing sorting pill names

You can customize the name on the pill for the specific column that's being sorted:

```php
Column::make('Name')
    ->setSortingPillTitle('Full Name')
```

### Customizing sorting pill directions

You can customize the directions on the pill for the specific column that's being sorted:

```php
Column::make('Name')
    // Instead of Name: A-Z it will say Name: Asc
    ->setSortingPillDirections('Asc', 'Desc')
```

## Misc.

### Eager Loading Relationships

If you need the access the relationships on the model from a format call or something of the like, you can eager load the relationships so you are not adding more queries:

```php
Column::make('Address', 'address.address')
    ->eagerLoadRelations() // Adds with('address') to the query
```

### Conditionally Hiding Columns

Sometimes you may want to hide columns based on certain conditions. You can use the `hideIf` method to conditionally hide columns:

```php
Column::make('Type', 'user.type')
    ->hideIf(request()->routeIs('this.other.route'))

Column::make('Last 4', 'card_last_four')
    ->hideIf(! auth()->user()->isAdmin())
```

### Excluding from Column Select

If you don't want a column to be able to be turned off from the column select box, you may exclude it:

```php
Column::make('Address', 'address.address')
    ->excludeFromColumnSelect()
```

### Preventing clicks if row URL is enabled

If you have row URLs enabled, but you have a specific column you do not want clickable, i.e. in the event there is something else clickable in that row, you may yse the following:

```php
Column::make('Name')
    ->unclickable(),
```

See more in the [clickable rows documentation](../rows/clickable-rows).