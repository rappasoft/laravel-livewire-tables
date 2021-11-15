---
title: Per-page dropdown
weight: 3
---

The per-page dropdown defaults to 10, 25, and 50 items per page.

You can overwrite this array on your component class with the `$perPageAccepted` property.

```php
public array $perPageAccepted = [100, 200, 500];
```

If you would like to add an option to show **All** results on one page, while still keeping pagination enabled you can set this class property:

```php
public bool $perPageAll = true;
```

This will add an `All` option to the end of the per-page dropdown.

If you would like to set the default selection in the dropdown to something other than the first, set `$perPage` equal to an item in your `$perPageAccepted` array.

For more options on configuring pagination and per-page see [Display](../display/properties).
