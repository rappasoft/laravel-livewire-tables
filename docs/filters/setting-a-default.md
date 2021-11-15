---
title: Setting a default
weight: 5
---

You can set a default filter by overriding the `$filters` property on the component using the same key you used to define your `filters()` method;

```php
public array $filters = [
    'type' => 'user',
];
```

The value must match one of the values specified on your filter's options.
