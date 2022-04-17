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