---
title: Creating bulk actions
weight: 2
---

To create bulk actions, you must specify a `method` and a `button title` in the `$bulkActions` component property.

```php
public array $bulkActions = [
    'exportSelected' => 'Export',
];
```

------

**The following method is only available in v1.16 and above**

As of v1.16 you can define bulk action with a method, so you can perform other actions to determine what your actions are or perform translations on the strings:

```php
public function bulkActions(): array
{
    // Figure out what actions the admin gets
    ...

    return [
        'activate'   => __('Activate'),
        'deactivate' => __('Deactivate'),
    ];
}
```

------

The **key** is the Livewire method to call, and the value is the name of the item in the bulk actions dropdown.

You can define your method to do whatever you want:

```php
public function exportSelected()
{
    // Do something with the selected rows.
}
```

See [Getting the selected rows query](./getting-the-selected-rows-query) or [Getting the selected keys](./getting-the-selected-keys) to understand how to work with the selected data.
