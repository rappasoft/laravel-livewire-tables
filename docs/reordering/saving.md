---
title: Saving
weight: 3
---

When you click the "Save" button, your ordered elements will be returned as an array, to the function you have configured.

You will receive a multi-dimensional array, containing an array item per record, with the primary key, and order field.

It is recommended that you perform some validation before bulk updating data, but it is in the correct format to perform upserts.

```php
public function reorder($items): void
{
    foreach ($items as $item) {
        User::find((int)$item['value'])->update(['sort' => (int)$item['order']]);
    }
}
```
