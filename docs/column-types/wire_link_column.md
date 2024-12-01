---
title: Wire Link Column (beta)
weight: 17
---

WireLink columns provide a way to display Wired Links in your table without having to use `format()` or partial views, with or without a Confirmation Message

WireLinkColumn requires title, and an "action", which must be a valid LiveWire method in the current class, or a global method

Without a Confirmation Message
```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->action(fn($row) => 'delete("'.$row->id.'")'),
```

You may also pass a string to "confirmMessage", which will utilise LiveWire 3's "wire:confirm" approach to display a confirmation modal.

```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->confirmMessage('Are you sure you want to delete this item?')
        ->action(fn($row) => 'delete("'.$row->id.'")')
        ->attributes(fn($row) => [
            'class' => 'btn btn-danger',
        ]),
```

And you may also pass an array of attributes, which will be applied to the "button" element used within the Column
```php
    WireLinkColumn::make("Delete Item")
        ->title(fn($row) => 'Delete Item')
        ->action(fn($row) => 'delete("'.$row->id.'")')
        ->attributes(fn($row) => [
            'class' => 'btn btn-danger',
        ]),
```

Please also see the following for other available methods:
<ul>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods">Available Methods</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection">Column Selection</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header">Secondary Header</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer">Footer</a>
    </li>
</ul>