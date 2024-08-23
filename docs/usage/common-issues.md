---
title: Common Issues
weight: 4
---

### Property Errors

The strong recommendation is to not publish the views for this package.  The vast majority of elements can be customised using methods within the package.

See "Available Methods" in most sections for details, some examples:
[DataTable Styling](../datatable/styling)
[Bulk Actions Styling](../bulk-actions/styling)

### Previously Published Views

The strong recommendation is to not publish the views for this package.  If you have published the views prior to v3.4.5, and do not wish to remove these, then you should add the following method, to disable the newer (more efficient) behaviour:

```php
public function configure(): void
{
  $this->useComputedPropertiesDisabled();
}
```
