---
title: Saving
weight: 3
---

When a row is moved, the table will call your reorder method on the component with the current order of the entire table:

```php
public function reorder($items): void
{
    foreach ($items as $item) {
        User::find((int)$item['value'])->update(['sort' => (int)$item['order']]);
    }
}
```
