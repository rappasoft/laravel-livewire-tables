---
title: Refreshing
weight: 1
---

**Disabled by default**, set the refresh parameters on the component.

**Note:** You should only enable one of the following methods on the component.

## poll

Set the refresh interval using a time string format. This is the recommended method for setting polling intervals.

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->poll('10s'); // Refresh every 10 seconds
}
```

Supported time formats:
- `'10s'` - 10 seconds
- `'30s'` - 30 seconds  
- `'1m'` - 1 minute
- `'5m'` - 5 minutes
- `'1h'` - 1 hour

## setRefreshTime

Set the amount of time in milliseconds as a refresh interval.

```php
public function configure(): void
{
    $this->setRefreshTime(2000); // Component refreshes every 2 seconds
}
```

## setRefreshKeepAlive

Keep polling when the tab with the component is in the background.

```php
public function configure(): void
{
    $this->setRefreshKeepAlive();
}
```

## setRefreshVisible

Only refresh the component when it is visible.

```php
public function configure(): void
{
    $this->setRefreshVisible();
}
```

## setRefreshMethod

Fire a specific action when polling.  This is only necessary when you wish to call additional actions on each refresh.  You must have a public function with the same name as the refresh method.

```php
public function configure(): void
{
    $this->setRefreshMethod('refreshTable');
}

public function refreshTable()
{
    // Custom Code Here
}
```
