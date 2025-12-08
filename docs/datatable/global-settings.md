---
title: Global Settings
weight: 7
---

Global settings allow you to configure default behavior for all tables in your application. This is useful for applying consistent settings across multiple tables without repeating configuration code.

## Basic Usage

Set up global configuration in your `AppServiceProvider` or any service provider:

```php
use Rappasoft\LaravelLivewireTables\DataTableComponent;

public function boot(): void
{
    DataTableComponent::configureUsing(function (DataTableComponent $table) {
        $table->poll('30s')
            ->setPerPageAccepted([10, 25, 50, 100])
            ->setOfflineIndicatorEnabled();
    });
}
```

## Common Use Cases

### Default Polling

Set a default polling interval for all tables:

```php
DataTableComponent::configureUsing(function (DataTableComponent $table) {
    $table->poll('30s');
});
```

### Default Pagination

Set default pagination options:

```php
DataTableComponent::configureUsing(function (DataTableComponent $table) {
    $table->setPerPageAccepted([10, 25, 50, 100])
        ->setPerPage(25);
});
```

### Default Theme

Set a default theme for all tables:

```php
DataTableComponent::configureUsing(function (DataTableComponent $table) {
    // Note: Theme is typically set via config, but you can override here
});
```

### Combined Configuration

Apply multiple default settings:

```php
DataTableComponent::configureUsing(function (DataTableComponent $table) {
    $table->poll('30s')
        ->setPerPageAccepted([10, 25, 50, 100])
        ->setPerPage(25)
        ->setOfflineIndicatorEnabled()
        ->setQueryStringEnabled();
});
```

## Overriding Global Settings

Global settings are applied **before** the `configure()` method is called, so you can override them in individual table components:

```php
// Global setting: poll every 30s
DataTableComponent::configureUsing(function (DataTableComponent $table) {
    $table->poll('30s');
});

// In your table component
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->poll('10s'); // Overrides global setting to 10s
}
```

## When to Use

Use global settings when:
- You want consistent behavior across all tables
- You need to apply the same configuration to many tables
- You want to reduce code duplication
- You need to set application-wide defaults

Avoid using global settings when:
- Tables have very different requirements
- You need fine-grained control per table
- Settings would conflict with individual table needs




