---
title: The Primary Key
weight: 3
---

Every row must have a primary key. By default, it will use `id`. But if you have something other than that such as `uuid` then you can use the `$primaryKey` property.

```php
public string $primaryKey = 'uuid';
```

See also, [troubleshooting](../usage/troubleshooting#4-if-you-are-getting-unexpected-row-results-after-filteringsearch-etc).
