---
title: Processing Bulk Actions
weight: 3
---

To process your bulk action you must have a method on the component with the same name as the key in the bulk actions array:

```php
public array $bulkActions = [
    'exportSelected' => 'Export',
];

public function exportSelected()
{

}
```

You have access to the `selectedKeys` method to grab the IDs of the rows that were selected:

```php
public function exportSelected()
{
    foreach($this->getSelected() as $item)
    {
        // These are strings since they came from an HTML element
    }
}
```

## Resetting

After you process your action you'll probably want to reset the screen back to normal, for this you can call the `clearSelected` method at the end:

```php
public function exportSelected()
{
    ...

    $this->clearSelected();
}
```
