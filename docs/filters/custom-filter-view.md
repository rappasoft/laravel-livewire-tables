---
title: Custom filter view
weight: 4
---

If you want full control over your filters, you can omit the `filters()` method and instead add a `filtersView()` method that return the string view name, which will be included in the master component on render. This is useful when you have different types of filters than the package offers:

You can take a look as the master component markup to get ideas on how best to lay out the filters UI.

```php
public function filtersView(): ?string
{
    return 'path.to.my.filters.view';
}
```

If you have this defined, it will take precedence over the `filters()` method.
