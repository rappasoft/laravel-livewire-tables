---
title: Deferred Loading
weight: 6
---

Deferred loading allows you to load table data asynchronously, which can improve perceived performance for tables with large datasets or slow queries.

## Basic Usage

Enable deferred loading in your table configuration:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->deferLoading();
}
```

## How It Works

When deferred loading is enabled:

1. The table component renders immediately with a loading state
2. The data query is executed asynchronously
3. Once the data is loaded, the table updates with the results

This is particularly useful for:
- Tables with complex queries that take time to execute
- Large datasets that benefit from showing the UI first
- Improving perceived performance and user experience

## Disabling Deferred Loading

To disable deferred loading:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->disableDeferredLoading();
}
```

## Checking Status

You can check if deferred loading is enabled:

```php
if ($this->deferredLoadingIsEnabled()) {
    // Deferred loading is active
}

if ($this->deferredLoadingIsDisabled()) {
    // Deferred loading is not active
}
```

## Best Practices

- Use deferred loading for tables with slow queries or large datasets
- Consider using it in combination with pagination for better performance
- The loading placeholder can be customized using the loading placeholder feature




