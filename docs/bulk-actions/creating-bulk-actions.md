---
title: Creating Bulk Actions
weight: 2
---

There are 3 ways to define your bulk actions.

They all do the same thing except provide different levels of flexibility.

The **key** is the Livewire method to call, and the value is the name of the item in the bulk actions dropdown.

## Property

The first way to define your bulk actions is with the `bulkActions` component property:

```php
public array $bulkActions = [
    'exportSelected' => 'Export',
];
```

## Method

You can also use the `bulkActions` method on the component:

```php
public function bulkActions(): array
{
    return [
        'exportSelected' => 'Export',
    ];
}
```

## Configuration

You can also set them via the component's configure method:

```php
public function configure(): void
{
    $this->setBulkActions([
        'exportSelected' => 'Export',
    ]);
}
```
