---
title: Summaries
weight: 5
---

Table summaries allow you to display aggregate calculations prominently above or below your table. This is useful for showing totals, averages, counts, and other aggregate values.

## Basic Usage

Add summaries to columns using the `summary()` method:

```php
public function columns(): array
{
    return [
        Column::make('Price', 'price')
            ->summary('sum'), // Sum of all prices
        Column::make('Quantity', 'quantity')
            ->summary('avg'), // Average quantity
        Column::make('Total Items')
            ->summary('count'), // Count of items
    ];
}
```

## Summary Types

### Sum

Calculate the sum of all values in a column:

```php
Column::make('Price', 'price')
    ->summary('sum'),
```

### Average

Calculate the average of all values in a column:

```php
Column::make('Rating', 'rating')
    ->summary('avg'),
```

### Count

Count the total number of rows:

```php
Column::make('Items')
    ->summary('count'),
```

### Min

Get the minimum value:

```php
Column::make('Lowest Price', 'price')
    ->summary('min'),
```

### Max

Get the maximum value:

```php
Column::make('Highest Price', 'price')
    ->summary('max'),
```

## Custom Summary Callback

You can provide a custom callback for more complex calculations:

```php
Column::make('Total Revenue')
    ->summary(function($rows) {
        return $rows->sum('price') * $rows->sum('quantity');
    }),
```

## Enabling Summaries

Summaries are automatically enabled when you add a `summary()` call to any column. However, you can explicitly control the summaries status:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->setSummariesEnabled(); // Explicitly enable
        // or
        ->setSummariesDisabled(); // Explicitly disable
}
```

## Accessing Summary Values

You can access summary values in your views or components:

```php
// Get all columns with summaries
$summaryColumns = $this->getSummaryColumns();

// Calculate summary for a specific column
$total = $this->calculateSummary($column, $this->getRows());
```

## Displaying Summaries

To display summaries in your table, you'll need to add summary rows to your view. The summaries are calculated based on the current filtered/paginated results.

**Note:** Summaries are calculated on the current page results by default. If you need to calculate summaries across all results (ignoring pagination), you'll need to fetch all rows separately.




