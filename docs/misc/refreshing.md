---
title: Refreshing
weight: 1
---

**Disabled by default**, set the refresh parameters on the component.

**Note:** You should only enable one of the following methods on the component.

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

Fire a specific action when polling.

```php
public function configure(): void
{
    $this->setRefreshMethod('refresh');
}
```
