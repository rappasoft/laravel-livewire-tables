---
title: Adding Custom Markup
weight: 3
---

If you would like to append any custom markup right before the end of the component, you may use the `customView` method and return a view.

This is good for loading extra content such as modals.

```php
public function customView(): string
{
    return 'includes.custom';
}
```

If you would like to append any custom markup right before the start of the component, you may use the `customViewPrepend` method and return a view.

This is good for loading extra content such as dismissible alerts or flash notifications.

```php
public function customViewPrepend(): string
{
    return 'includes.custom';
}
```
